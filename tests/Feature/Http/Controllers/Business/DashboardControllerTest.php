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
    const USER_STATS_ROUTE = 'user.stats';
    const TRAFFIC_STATS_ROUTE = 'traffic.stats';
    const TIME_WORKED_ROUTE = 'time.worked';
    const JOBS_GRAPH_ROUTE = 'jobs.graph';
    const PAYOUTS_GRAPH_ROUTE = 'payouts.graph';
    const LEADERBOARD_ROUTE = 'business.leaderboard';

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
     * @covers ::userStats
     */
    public function testUserStats()
    {
        $response = $this->get(route(self::USER_STATS_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['total', 'growth']]);
        $this->document(self::DOC_PATH, self::USER_STATS_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::trafficStats
     */
    public function testTrafficStats()
    {
        $response = $this->get(route(self::TRAFFIC_STATS_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['total', 'growth']]);
        $this->document(self::DOC_PATH, self::TRAFFIC_STATS_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::leaderboard
     */
    public function testLeaderboard()
    {
        $response = $this->get(route(self::LEADERBOARD_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['id', 'username', 'amount', 'rating']]]);
        $this->document(self::DOC_PATH, self::LEADERBOARD_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::totalTimeWorked
     */
    public function testTotalTimeWorked()
    {
        $response = $this->get(route(self::TIME_WORKED_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['minutes']]);
        $this->document(self::DOC_PATH, self::TIME_WORKED_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::payoutsGraph
     */
    public function testPayoutsGraph()
    {
        $response = $this->get(route(self::PAYOUTS_GRAPH_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['labels', 'datasets']]);
        $this->document(self::DOC_PATH, self::PAYOUTS_GRAPH_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::jobsGraph
     */
    public function testJobsGraph()
    {
        $response = $this->get(route(self::JOBS_GRAPH_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['labels', 'datasets']]);
        $this->document(self::DOC_PATH, self::JOBS_GRAPH_ROUTE, $response->status(), $response->getContent());
    }
}
