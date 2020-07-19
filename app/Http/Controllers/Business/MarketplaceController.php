<?php

namespace App\Http\Controllers\Business;

use App\Contracts\Repositories\UserRepository;
use App\Enum\Marketplace\ProposalStatus;
use App\Enum\Marketplace\Status;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\MarketplaceJob;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;

/**
 * @Group(name="Marketplace", description="These routes manage the company's marketplace.")
 */
class MarketplaceController extends Controller
{
    /**
     * @var Dispatcher
     */
    private $eventDispatcher;

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(Dispatcher $eventDispatcher , UserRepository $userRepository)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->userRepository = $userRepository;
    }

    /**
     * @Meta(name="All Jobs", description="View all jobs in a business marketplace.", href="all-jobs")
     * @ResponseExample(status=200, example="responses/business/marketplace/all.marketplace.jobs-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $marketplaceJobs = $business->marketplaceJobs()
            ->with(['customer.profile', 'proposals.user.profile', 'category'])
            ->get();

        return ResponseFactory::success('Show all marketplace jobs', $marketplaceJobs);
    }

    /**
     * @Meta(name="Show job", description="Show a single job in a business marketplace.", href="show-job")
     * @ResponseExample(status=200, example="responses/business/marketplace/show.marketplace.job-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $marketplaceJob = $business->marketplaceJobs()
            ->with(['customer.profile', 'proposals.user.profile', 'category', 'location'])
            ->where('id', '=', $request->id)
            ->first();

        if (is_null($marketplaceJob)) {
            return ResponseFactory::error(
                'This job does not exist or you are not authorized',
                null,
                404
            );
        }


        return ResponseFactory::success('Show single job', $marketplaceJob);
    }

    /**
     * @meta(name="Assign worker", description="Assign a worker to a job", href="assign-job")
     * @BodyParam(name="worker_id", type="numeric", status="required", description="The id of the worker being assigned", example="4")
     * @ResponseExample(status=200)
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function assign(Request $request)
    {

        $this->validate($request, [
            'worker_id' => 'required'
        ]);

        /** @var Business $business */
        $business = $request->get('business');

        /** @var MarketplaceJob $marketplaceJob */
        $marketplaceJob = $business->marketplaceJobs()
            ->where('id' , '=' , $request->id)
            ->first();

        /** @var $worker */
        $worker = $business->users()
            ->where('user_id' , '=' , $request->worker_id)
            ->first();

        if (is_null($marketplaceJob)) {
            return ResponseFactory::error('Job does not exist for this business');
        }
        if (is_null($worker)) {
            return ResponseFactory::error('Worker does not exist or is not authorized');
        }

        if ($marketplaceJob->isRequested()) {

            $marketplaceJob->proposals()->create([
                'marketplace_id' => $marketplaceJob->id,
                'user_id' => $worker->id,
                'status_id' => $marketplaceJob->status_id,
            ]);

            $marketplaceJob->update(['status_id' => Status::PENDING_APPROVAL]);

            $this->eventDispatcher->dispatch(new FreelancerHasAcceptedRequest($marketplaceJob));

        } elseif ($marketplaceJob->isComplete()) {
            return ResponseFactory::error('The job is already complete');
        } elseif ($marketplaceJob->status_id == Status::PENDING_APPROVAL) {
            $marketplaceJob->proposals()->first()->update(['user_id' => $worker->id]);
        } else {
            $marketplaceJob->proposals()
                ->where('status_id', '=', ProposalStatus::APPROVED)
                ->first()
                ->update(['user_id' => $worker->id]);
        }

        return ResponseFactory::success('Assigned worker to a Job');
    }
}
