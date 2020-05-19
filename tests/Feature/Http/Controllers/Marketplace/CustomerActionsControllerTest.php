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
use Tests\ResponseFactoryTest;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\Marketplace\CustomerActionsController
 */
class CustomerActionsControllerTest extends TestCase
{
    const DOC_PATH = 'marketplace/customer-actions';
    const APPROVE_FREELANCER_ROUTE = 'approve.freelancer';

    /**
     * @var User
     */
    private $customer;

    /**
     * @var User
     */
    private $worker;

    /**
     * @var MarketplaceJobRepository
     */
    private $marketplaceJobRepository;

    /**
     * @var Business
     */
    private $business;

    protected function setUp(): void
    {
        parent::setUp();
        /** @var UserRepository $userRepository */
        $userRepository = $this->app->make(UserRepository::class);
        /** @var MarketplaceJobRepository $marketplaceRepository */
        $this->marketplaceJobRepository = $this->app->make(MarketplaceJobRepository::class);
        $this->worker = $userRepository->find(2);
        $this->customer = $userRepository->find(1);
        // Get the business
        $this->business = $this->app->make(BusinessRepository::class)->find(1);
        Sanctum::actingAs($this->customer);
    }

    /**
     * @covers ::approve
     */
    public function testApproveWorker()
    {
        // Get the first pending job
        $marketplaceJob = $this->marketplaceJobRepository->find(2);
        $response = $this->post(route(self::APPROVE_FREELANCER_ROUTE, [
            'unique_id' => $this->business->unique_id,
            'id' => $marketplaceJob->id,
            'freelancer_id' => $this->worker->id
        ]));

        dd($response->getContent());

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('You have approved this worker'));
        $this->document(self::DOC_PATH, self::APPROVE_FREELANCER_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
