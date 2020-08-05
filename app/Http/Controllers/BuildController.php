<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\DeploymentRepository;
use App\Enum\Business\DeploymentStatus;
use App\Factories\ResponseFactory;
use App\Notifications\Business\AppDeploymentFailedNotification;
use App\Notifications\Business\AppDeploymentSucceededNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BuildController extends Controller
{
    /**
     * @var DeploymentRepository
     */
    private $deploymentRepository;

    public function __construct(DeploymentRepository $deploymentRepository)
    {
        $this->deploymentRepository = $deploymentRepository;
    }

    /**
     * Show all queued deployments
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relations = ['business', 'business.profile', 'business.location', 'business.businessApp'];
        $deployments = $this->deploymentRepository->with($relations)->findWhere(['deployment_status_id' => DeploymentStatus::QUEUED]);

        return ResponseFactory::success('Show deployments', $deployments);
    }

    /**
     * Start a deployment
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function start(Request $request)
    {
        $this->validate($request, ['deployment_id' => 'exists:deployments,id']);
        $deployment = $this->deploymentRepository->find($request->deployment_id);

        $deployment->update(['start_time' => Carbon::now()->toDateTimeString(), 'deployment_status_id' => DeploymentStatus::PROCESSING]);

        // @todo: Add deployment notification noted here: https://favr.atlassian.net/browse/GIGWERK-187

        return ResponseFactory::success('Deployment has started.', $deployment);
    }

    /**
     * End a deployment
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function end(Request $request)
    {
        $this->validate($request, [
            'deployment_id' => ['exists:deployments,id'],
            'success' => ['required', 'bool'],
            'failure_message' => ['exclude_unless:success,false', 'required', 'string']
        ]);

        $deployment = $this->deploymentRepository->find($request->deployment_id);

        if (!$request->success) {
            $deployment->business->owner->notify(new AppDeploymentFailedNotification($deployment));
            // access the failure message using: $request->failure_message
            $deployment->update(['end_time' => Carbon::now()->toDateTimeString(), 'deployment_status_id' => DeploymentStatus::FAILED]);
            return ResponseFactory::error('Deployment has ended.', $deployment);
        }

        $deployment->business->owner->notify(new AppDeploymentSucceededNotification($deployment));
        $deployment->update(['end_time' => Carbon::now()->toDateTimeString(), 'deployment_status_id' => DeploymentStatus::COMPLETED]);


        return ResponseFactory::success('Deployment has ended.', $deployment);
    }
}
