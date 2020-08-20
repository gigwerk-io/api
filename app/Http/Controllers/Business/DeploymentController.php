<?php

namespace App\Http\Controllers\Business;

use App\Enum\Business\DeploymentStatus;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Notifications\Business\DeploymentQueuedNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;

/**
 * @Group(name="Deployments", description="Manage a businesses app deployments.")
 */
class DeploymentController extends Controller
{
    /**
     * @Meta(name="All Deployments", description="List out all of a businesses app deployments.", href="all-deployments")
     * @ResponseExample(example="responses/business/deployment/show.deployments-200.json", status=200)
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $deployments = $business->deployments()->get();

        return ResponseFactory::success('Show deployments', $deployments);
    }

    /**
     * @Meta(name="Queue Deployment", description="Queue a deployment to be built later.", href="queue-deployment")
     * @ResponseExample(example="responses/business/deployment/queue.deployment-200.json", status=200)
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        $deployment = $business->deployments()->create(['deployment_status_id' => DeploymentStatus::QUEUED, 'id' => Str::uuid()]);

        $business->notify(new DeploymentQueuedNotification($business));

        return ResponseFactory::success('Deployment has been queued.');
    }
}
