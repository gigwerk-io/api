<?php

namespace Tests\Feature\Http\Controllers\Marketplace;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\MarketplaceJobRepository;
use App\Contracts\Repositories\UserRepository;
use App\Models\Business;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\Marketplace\FeedController
 */
class FeedControllerTest extends TestCase
{
    const DOC_PATH = 'marketplace/feed';
    const JOB_FEED_ROUTE = 'job.feed';
    const CUSTOMER_JOBS_ROUTE = 'customer.jobs';
    const WORKER_JOBS_ROUTE = 'worker.jobs';
    const VIEW_JOB_ROUTE = 'view.job';

    /**
     * @var User
     */
    private $customer;

    /**
     * @var User
     */
    private $worker;

    /**
     * @var Business
     */
    private $business;


    protected function setUp(): void
    {
        parent::setUp();
        // Get customer
        $this->customer = $this->app->make(UserRepository::class)->find(1);
        // Get primary worker
        $this->worker = $this->app->make(UserRepository::class)->find(2);
        // Get the business
        $this->business = $this->app->make(BusinessRepository::class)->find(1);
        // Get the first job
    }

    /**
     * @covers ::show
     */
    public function testViewSingleJobWithoutCoords()
    {
        Sanctum::actingAs($this->worker);
        $marketplace = $this->app->make(MarketplaceJobRepository::class)->find(1);
        $response = $this->get(route(self::VIEW_JOB_ROUTE, ['unique_id' => $this->business->unique_id, 'id' => $marketplace->id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['customer', 'business_id']]);
        $this->document(self::DOC_PATH, self::VIEW_JOB_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::show
     */
    public function testViewSingleJob()
    {
        Sanctum::actingAs($this->worker);
        $marketplace = $this->app->make(MarketplaceJobRepository::class)->find(1);
        $response = $this->get(route(self::VIEW_JOB_ROUTE, ['unique_id' => $this->business->unique_id, 'id' => $marketplace->id]), [
            'params' => [
                'lat' => 44.018970,
                'long' => -92.463670
            ]
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['customer']]);
        $this->document(self::DOC_PATH, self::VIEW_JOB_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::feed
     */
    public function testJobFeed()
    {
        Sanctum::actingAs($this->worker);
        $response = $this->get(route(self::JOB_FEED_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['customer', 'business_id']]]);
        $this->document(self::DOC_PATH, self::JOB_FEED_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::myJobRequests
     */
    public function testCustomerJobs()
    {
        Sanctum::actingAs($this->customer);
        $response = $this->get(route(self::CUSTOMER_JOBS_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['customer', 'business_id']]]);
        $this->document(self::DOC_PATH, self::CUSTOMER_JOBS_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::myProposals
     */
    public function testWorkerJobs()
    {
        Sanctum::actingAs($this->worker);
        $response = $this->get(route(self::WORKER_JOBS_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['customer', 'business_id']]]);
        $this->document(self::DOC_PATH, self::WORKER_JOBS_ROUTE, $response->status(), $response->getContent());
    }
}
