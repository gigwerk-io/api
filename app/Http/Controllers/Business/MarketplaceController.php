<?php

namespace App\Http\Controllers\Business;

use App\Contracts\Repositories\UserRepository;
use App\Enum\Marketplace\Status;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Marketplace\CustomerActionsController;
use App\Models\Business;
use App\Models\MarketplaceJob;
use Composer\EventDispatcher\EventDispatcher;
use Illuminate\Http\Request;
use Lukeraymonddowning\Poser\Tests\Models\User;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;

/**
 * @Group(name="Marketplace", description="These routes manage the company's marketplace.")
 */
class MarketplaceController extends Controller
{
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
     * @ResponseExample(status=200, example="...."
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function assign(Request $request)
    {
        // probably not validating the right field
        $this->validate($request, [
            'id' => 'exists:marketplace_jobs,id',
        ]);

        /** @var Business $business */
        $business = $request->get('business');

        /** @var MarketplaceJob $job */
        $job = $business->marketplaceJobs()
            ->where('id' , '=' , $request->id)
            ->first();

        //probably not right - unsure how to use the CustomerActionsController for it tho
        /** @var $worker */
        $worker = $business->users()
            ->where('id' , '=' , $request->id)
            ->first();

        if (is_null($worker))
            return ResponseFactory::error('Worker does not exist or is not authorized');

        if ($job->isRequested()) {
            $job->proposals()->create([
               'marketplace_id' => $job->id,
               'user_id' => $worker->id,
            ]);

            // took this from old assign function - not sure freelancer_accepted is the right key
            $job->update(['freelancer_accepted' => true, 'status_id' => Status::PENDING_APPROVAL]);
            //same issue with eventDispatcher as userRepository mentioned above
//            EventDispatcher::dispatch(new FreelancerHasAcceptedRequest($job));
        }
        elseif ($job->isComplete())
            return ResponseFactory::error('The Job is already complete');
        elseif ($job->status_id == Status::PENDING_APPROVAL)
            $job->proposals()->first()->update(['user_id' => $worker->id]);
        else
            $job->proposals()
                ->where('status_id', '=' , 2) // not sure this is correct or proper either
                ->first()
                ->update(['user_id' => $worker->id]);

        return ResponseFactory::success('Assigned worker to a job');
    }
}
