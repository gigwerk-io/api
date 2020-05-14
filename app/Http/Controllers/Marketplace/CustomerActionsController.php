<?php

namespace App\Http\Controllers\Marketplace;

use App\Contracts\Repositories\MarketplaceJobRepository;
use App\Contracts\Repositories\UserRepository;
use App\Contracts\Stripe\Connect;
use App\Enum\Marketplace\ProposalStatus;
use App\Enum\Marketplace\Status;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\MarketplaceJob;
use Carbon\Carbon;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;

class CustomerActionsController extends Controller
{
    /**
     * @var Dispatcher
     */
    private $eventDispatcher;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var Connect
     */
    private $connect;

    /**
     * @var MarketplaceJobRepository
     */
    private $marketplaceJobRepository;


    public function __construct(Dispatcher $eventDispatcher, UserRepository $userRepository, Connect $connect, MarketplaceJobRepository $marketplaceJobRepository)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->userRepository = $userRepository;
        $this->connect = $connect;
        $this->marketplaceJobRepository = $marketplaceJobRepository;
    }

    /**
     * Approved Freelancer
     * Approve a freelancer's proposal.
     * @urlParam unique_id required The uuid of the businesses marketplace. Example: 92c42544-773c-4ce9-9708-d67ffe17adfc
     * @urlParam id required The ID of the job. Example: 1
     * @urlParam freelancer_id required The ID of the worker. Example: 1
     *
     * @param $freelancer_id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function approve($freelancer_id, Request $request)
    {
        /** @var MarketplaceJob $marketplaceJob */
        $marketplaceJob = $request->get('job');

        $proposal = $marketplaceJob->proposals()
            ->where('user_id', '=', $freelancer_id)
            ->where('status_id', '=', ProposalStatus::PENDING)
            ->first();

        if (is_null($proposal)) {
            return ResponseFactory::error('This worker does not have a proposal for this job.');
        }

        $proposal->update([
            'status_id' => ProposalStatus::APPROVED
        ]);

        $marketplaceJob->update(['status_id' => Status::APPROVED]);

        // $this->eventDispatcher->dispatch(new CustomerHasAcceptedWorker($this->marketplace, $this->userRepository->find($freelancer_id)));

        return ResponseFactory::success(
            'You have approved this worker'
        );
    }

    /**
     * Reject Worker
     * Reject a workers proposal on a job.
     * @urlParam unique_id required The uuid of the businesses marketplace. Example: 92c42544-773c-4ce9-9708-d67ffe17adfc
     * @urlParam id required The ID of the job. Example: 1
     * @urlParam freelancer_id required The ID of the worker. Example: 1
     *
     * @param $freelancer_id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function reject($freelancer_id, Request $request)
    {
        /** @var MarketplaceJob $marketplaceJob */
        $marketplaceJob = $request->get('job');

        $proposal = $marketplaceJob->proposals()
            ->where('user_id', '=', $freelancer_id)
            ->where('status_id', '=', ProposalStatus::PENDING)
            ->first();

        if (is_null($proposal)) {
            return ResponseFactory::error('This worker does not have a proposal for this job.');
        }

        $proposal->update([
            'status_id' => ProposalStatus::REJECTED
        ]);

        $marketplaceJob->update(['status_id' => Status::REQUESTED]);

        return ResponseFactory::success(
            'You have rejected this worker'
        );
    }

    /**
     * Cancel Job
     * Remove a job from the marketplace. The job must not be in progress or completed.
     * @urlParam unique_id required The uuid of the businesses marketplace. Example: 92c42544-773c-4ce9-9708-d67ffe17adfc
     * @urlParam id required The ID of the job. Example: 1
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function cancel(Request $request)
    {
        /** @var MarketplaceJob $marketplaceJob */
        $marketplaceJob = $request->get('job');

        if (!in_array($marketplaceJob->status_id, [Status::REQUESTED, Status::PENDING_APPROVAL])) {
            if ($marketplaceJob->isComplete()) {
                return ResponseFactory::error(
                    'This job has already been completed.'
                );
            }
            return ResponseFactory::error(
                'You can not cancel a job that is in progress'
            );
        }

        // $this->eventDispatcher->dispatch(new CustomerHasCancelledRequest($this->marketplace));
        $marketplaceJob->delete();
        return ResponseFactory::success(
            'Your request has been deleted.'
        );
    }

    /**
     * Review Job
     * Mark the job as complete.
     * @urlParam unique_id required The uuid of the businesses marketplace. Example: 92c42544-773c-4ce9-9708-d67ffe17adfc
     * @urlParam id required The ID of the job. Example: 1
     * @bodyParam rating number required The rating of the worker. Example: 5
     * @bodyParam review string optional The review of the worker. Example: This is worker did a good job!
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function complete(Request $request)
    {
        /** @var MarketplaceJob $marketplaceJob */
        $marketplaceJob = $request->get('job');
        $this->validate($request, [
            'rating' => ['required', 'numeric', 'min:1', 'max:5'],
            'review' => ['string']
        ]);

        if (!$marketplaceJob->isInProgress()) {
            return ResponseFactory::error('Illegal status transition.');
        }

        $proposal = $marketplaceJob->proposals()
            ->where('status_id', '=', ProposalStatus::APPROVED)
            ->whereNotNull('arrived_at')
            ->first();

        if (is_null($proposal)) {
            return ResponseFactory::error('This worker does not have a proposal for this job.');
        }

        $proposal->update([
            'completed_at' => Carbon::now()->toDateTimeString(),
            'rating' => $request->rating,
            'review' => $request->review
        ]);

        $freelancer = $proposal->user;

        $transfer = $this->connect->createPayout(
            $freelancer->payoutMethod->stripe_connect_id,
            $marketplaceJob->price
        );

        $marketplaceJob->payout()->create([
            'user_id' => $freelancer->id,
            'amount' => centsToDollars($transfer->amount),
            'stripe_token' => $transfer->id
        ]);

        // $this->eventDispatcher->dispatch(new CustomerMarkedRequestAsComplete($this->marketplace));

        return ResponseFactory::success(
            'This job has been marked complete'
        );
    }
}
