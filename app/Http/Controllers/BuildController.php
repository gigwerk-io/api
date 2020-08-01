<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\DeploymentRepository;
use App\Enum\Business\DeploymentStatus;
use App\Factories\ResponseFactory;
use App\Models\Business;
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
        $deployments = $this->deploymentRepository->with('business')->findWhere(['deployment_status_id' => DeploymentStatus::QUEUED]);

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

        $deployment->update(['start_time' => Carbon::now()->toDateString(), 'status' => DeploymentStatus::PROCESSING]);

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
        $this->validate($request, ['deployment_id' => ['exists:deployments,id'], 'success' => ['required', 'bool']]);


        $deployment = $this->deploymentRepository->find($request->deployment_id);

        if (!$request->success) {
            // @todo: Add deployment failed notification noted here: https://favr.atlassian.net/browse/GIGWERK-179
            $deployment->update(['end_time' => Carbon::now()->toDateString(), 'status' => DeploymentStatus::FAILED]);
        }

        // @todo: Add deployment success notification noted here: https://favr.atlassian.net/browse/GIGWERK-180
        $deployment->update(['end_time' => Carbon::now()->toDateString(), 'status' => DeploymentStatus::COMPLETED]);


        return ResponseFactory::success('Deployment has ended.', $deployment);
    }
}
