<?php

namespace Tests\Feature\Http\Controllers;

use App\Contracts\Repositories\DeploymentRepository;
use App\Enum\Business\DeploymentStatus;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\BuildController
 */
class BuildControllerTest extends TestCase
{
    const QUEUED_DEPLOYMENTS_ROUTE = 'queued.deployments';
    const START_DEPLOYMENT_ROUTE = 'start.deployment';
    const END_DEPLOYMENT_ROUTE = 'end.deployment';

    public $queuedDeployment;

    public $startedDeployment;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->queuedDeployment = $this->app->make(DeploymentRepository::class)->create([
            'deployment_status_id' => DeploymentStatus::QUEUED,
            'id' => Str::uuid(),
            'business_id' => 1
        ]);

        $this->startedDeployment = $this->app->make(DeploymentRepository::class)->create([
            'deployment_status_id' => DeploymentStatus::PROCESSING,
            'id' => Str::uuid(),
            'start_time' => Carbon::now(),
            'business_id' => 1
        ]);
    }

    /**
     * @covers ::index
     */
    public function testShowQueuedDeployments()
    {
        $response = $this->get(route(self::QUEUED_DEPLOYMENTS_ROUTE));

        $response->assertStatus(200);
    }

    /**
     * @covers ::start
     */
    public function testStartDeployment()
    {
        $response = $this->put(route(self::START_DEPLOYMENT_ROUTE, ['deployment_id' => $this->queuedDeployment->id]));

        $response->assertStatus(200);
    }

    /**
     * @covers ::end
     */
    public function testEndDeployment()
    {
        $response = $this->put(route(self::END_DEPLOYMENT_ROUTE, ['deployment_id' => $this->startedDeployment->id]), ['success' => true]);

        $response->assertStatus(200);
    }
}
