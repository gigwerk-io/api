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
 * @coversDefaultClass \App\Http\Controllers\Business\MarketplaceController
 */
class MarketplaceControllerTest extends TestCase
{
    const DOC_PATH = 'business/marketplace';
    const ALL_JOBS_ROUTE = 'all.marketplace.jobs';
    const SHOW_JOB_ROUTE = 'show.marketplace.job';

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
    public function testViewAllJobs()
    {
        $response = $this->get(route(self::ALL_JOBS_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['customer', 'proposals', 'category', 'price', 'description']]]);
        $this->document(self::DOC_PATH, self::ALL_JOBS_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::show
     */
    public function testShowJob()
    {
        $response = $this->get(route(self::SHOW_JOB_ROUTE, ['unique_id' => $this->business->unique_id, 'id' => 1]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['customer', 'proposals', 'category', 'price', 'description', 'location']]);
        $this->document(self::DOC_PATH, self::SHOW_JOB_ROUTE, $response->status(), $response->getContent());
    }
}
