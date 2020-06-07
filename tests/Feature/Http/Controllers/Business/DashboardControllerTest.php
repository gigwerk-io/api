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
    const STATS_ROUTE = 'stats';
    const GRAPHS_ROUTE = 'graphs';
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
     * @covers ::stats
     */
    public function testStats()
    {
        $response = $this->get(route(self::STATS_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['jobs', 'payments']]);
        $this->document(self::DOC_PATH, self::STATS_ROUTE, $response->status(), $response->getContent());
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
}
