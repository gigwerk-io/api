<?php

namespace Tests\Feature\Http\Controllers\Business;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\UserRepository;
use App\Enum\Business\DeploymentStatus;
use App\Models\Business;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\Business\DeploymentController
 */
class DeploymentControllerTest extends TestCase
{
    const DOC_PATH = 'business/deployment';
    const ALL_DEPLOYMENTS_ROUTE = 'show.deployments';
    const QUEUED_DEPLOYMENT_ROUTE = 'queue.deployment';

    /**
     * @var User
     */
    private $admin;

    /**
     * @var Business
     */
    private $business;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = $this->app->make(UserRepository::class)->find(1);
        // Get the business
        $this->business = $this->app->make(BusinessRepository::class)->find(1);
        Sanctum::actingAs($this->admin);
    }

    /**
     * @covers ::index
     */
    public function testViewAllDeployments()
    {
        // seed deployment
        $this->business->deployments()->create([
            'deployment_status_id' => DeploymentStatus::PROCESSING,
            'id' => Str::uuid(),
            'start_time' => Carbon::now()->toDateTimeString()
        ]);
        $response = $this->get(route(self::ALL_DEPLOYMENTS_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['status', 'build_time']]]);
        $this->document(self::DOC_PATH, self::ALL_DEPLOYMENTS_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::store
     */
    public function testQueueDeployment()
    {
        $response = $this->post(route(self::QUEUED_DEPLOYMENT_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $this->document(self::DOC_PATH, self::QUEUED_DEPLOYMENT_ROUTE, $response->status(), $response->getContent());
    }
}
