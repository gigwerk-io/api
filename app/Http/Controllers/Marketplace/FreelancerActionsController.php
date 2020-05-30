<?php

namespace App\Http\Controllers\Marketplace;

use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;
use App\Contracts\Stripe\Billing;
use App\Enum\Marketplace\ProposalStatus;
use App\Enum\Marketplace\Status;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\MarketplaceJob;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;

/**
 * @Group(name="Freelancer Actions", description="These routes belong are responsible for managing freelancer actions on a job.")
 */
class FreelancerActionsController extends Controller
{
    /**
     * @var Dispatcher
     */
    private $eventDispatcher;

    /**
     * @var Billing
     */
    private $billing;


    public function __construct(Dispatcher $eventDispatcher, Billing $billing)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->billing = $billing;
    }

    /**
     * @Meta(name="Accept Job", description="Propose to complete a customer job request.", href="accept-job")
     * @ResponseExample(status=200, example="responses/marketplace/freelancer-actions/accept.job-200.json")
     * @ResponseExample(status=400, example="responses/marketplace/freelancer-actions/accept.job-400.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function accept(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        /** @var MarketplaceJob $marketplaceJob */
        $marketplaceJob = $request->get('job');

        if($marketplaceJob->customer_id == $user->id){
            return ResponseFactory::error(
                'You cannot accept your own job.'
            );
        }

        if (!$marketplaceJob->isAcceptable()) {
            return ResponseFactory::error(
                'You have already proposed on this job.'
            );
        }

        if($marketplaceJob->proposals()->where('user_id', '=', $user->id)->exists()){
            return ResponseFactory::error(
                'You have already proposed on this job.'
            );
        }

        $marketplaceJob->proposals()->create([
            'user_id' => $user->id,
            'status_id' => ProposalStatus::PENDING
        ]);

        $marketplaceJob->update(['status_id' => Status::PENDING_APPROVAL]);

        // $this->eventDispatcher->dispatch(new FreelancerHasAcceptedRequest($this->marketplace));

        return ResponseFactory::success(
            'The customer has been notified of your proposal.'
        );
    }

    /**
     * @Meta(name="Withdraw Proposal", description="Withdraw from a customers job request.", href="withdraw")
     * @ResponseExample(status=200, example="responses/marketplace/freelancer-actions/withdraw.job-200.json")
     * @ResponseExample(status=400, example="responses/marketplace/freelancer-actions/withdraw.job-400.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function withdraw(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        /** @var MarketplaceJob $marketplaceJob */
        $marketplaceJob = $request->get('job');

        if(!$marketplaceJob->isWithdrawable()) {
            return ResponseFactory::error(
                'Illegal status transition.'
            );
        }

        $proposal = $marketplaceJob->proposals()->where('user_id', '=', $user->id)->first();
        if(is_null($proposal)) {
            return ResponseFactory::error('This proposal does not exist.');
        }

        $proposal->delete();

        $marketplaceJob->update(['status_id' => Status::REQUESTED]);

        return ResponseFactory::success('You have withdrawn from this job.');
    }

    /**
     * @Meta(name="Arrive To Job", description="A worker has arrived to the job. This is where the customer gets charged.", href="arrive")
     * @ResponseExample(status=200, example="responses/marketplace/freelancer-actions/freelancer.arrive-200.json")
     * @ResponseExample(status=400, example="responses/marketplace/freelancer-actions/freelancer.arrive-400.json")
     * @urlParam id required The ID of the job. Example: 1
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function arrive(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        /** @var MarketplaceJob $marketplaceJob */
        $marketplaceJob = $request->get('job');
        /** @var Business $business */
        $business = $request->get('business');

        if(!$marketplaceJob->isArrivable()){
            return ResponseFactory::error('Illegal status transition.');
        }

        if(!$marketplaceJob->workerIsApproved($user->id)) {
            return ResponseFactory::error('You are not the freelancer on this job.');
        }

        $proposal = $marketplaceJob->proposals()->where('user_id', '=', $user->id)->first();

        $proposal->update(['arrived[_at' => Carbon::now()->toDateTimeString()]);

        $marketplaceJob->update(['status_id' => Status::IN_PROGRESS]);

        $charge = $this->billing->createCharge(
            $marketplaceJob->customer->primaryPaymentMethod->stripe_customer_id,
            $marketplaceJob->price,
            sprintf('%s: %s', $business->name, $marketplaceJob->description)
        );

        $marketplaceJob->payment()->create([
            'user_id' => $marketplaceJob->customer_id,
            'amount' => centsToDollars($charge->amount),
            'stripe_token' => $charge->id
        ]);

        // $this->eventDispatcher->dispatch(new FreelancerHasArrived($this->marketplace));

        return ResponseFactory::success(
            'Your customer has been notified of your arrival.'
        );
    }

    /**
     * @Meta(name="Complete Job", description="The worker has completed the job and is waiting for the customer to confirm.", href="complete")
     * @ResponseExample(status=200, example="responses/marketplace/freelancer-actions/freelancer.arrive-200.json")
     * @ResponseExample(status=400, example="responses/marketplace/freelancer-actions/freelancer.arrive-400.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function complete(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        /** @var MarketplaceJob $marketplaceJob */
        $marketplaceJob = $request->get('job');

        if(!$marketplaceJob->isCompletable()) {
            return ResponseFactory::error('Illegal status transition.');
        }

        if(!$marketplaceJob->workerHasArrived($user->id)){
            return ResponseFactory::error('You are not the freelancer on this job.');
        }

        $proposal = $marketplaceJob->proposals()->where('user_id', '=', $user->id)->first();
        $proposal->update(['completed_at' => Carbon::now()->toDateTimeString()]);

        // $this->eventDispatcher->dispatch(new FreelancerHasCompletedRequest($this->marketplace));

        return ResponseFactory::success(
            'The customer has been notified of your completion'
        );
    }
}
