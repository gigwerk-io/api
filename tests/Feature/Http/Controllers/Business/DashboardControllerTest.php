<?php

namespace Tests\Feature\Http\Controllers\Business;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\UserRepository;
use App\Models\Business;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\Business\DashboardController
 */
class DashboardControllerTest extends TestCase
{
    const DOC_PATH = 'business/dashboard';
    const METRICS_ROUTE = 'metrics';
    const GRAPHS_ROUTE = 'graphs';

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
     * @covers ::metrics
     */
    public function testMetrics()
    {
        $response = $this->get(route(self::METRICS_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['applications', 'workers', 'hiring', 'jobs']]);
        $this->document(self::DOC_PATH, self::METRICS_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::graphs
     */
    public function testGraphs()
    {
        $response = $this->get(route(self::GRAPHS_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => []]);
        $this->document(self::DOC_PATH, self::GRAPHS_ROUTE, $response->status(), $response->getContent());
    }
}
