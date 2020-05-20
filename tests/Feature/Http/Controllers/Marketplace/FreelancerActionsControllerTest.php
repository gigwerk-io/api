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
 * @coversDefaultClass \App\Http\Controllers\Marketplace\FreelancerActionsController
 */
class FreelancerActionsControllerTest extends TestCase
{
    const DOC_PATH = 'marketplace/freelancer-actions';
    const ACCEPT_JOB_ROUTE = 'accept.job';
    const WITHDRAW_JOB_ROUTE = 'withdraw.job';
    const FREELANCER_ARRIVE_ROUTE = 'freelancer.arrive';
    const FREELANCER_COMPLETE_ROUTE = 'freelancer.complete';

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
        Sanctum::actingAs($this->worker);
    }

    /**
     * @covers ::accept
     */
    public function testAcceptJob()
    {
        $marketplaceJob = $this->marketplaceJobRepository->find(1);
        $response = $this->post(route(self::ACCEPT_JOB_ROUTE, [
            'unique_id' => $this->business->unique_id,
            'id' => $marketplaceJob->id,
        ]));


        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('The customer has been notified of your proposal.'));
        $this->document(self::DOC_PATH, self::ACCEPT_JOB_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::accept
     */
    public function testAcceptJobFail()
    {
        $marketplaceJob = $this->marketplaceJobRepository->find(2);
        $response = $this->post(route(self::ACCEPT_JOB_ROUTE, [
            'unique_id' => $this->business->unique_id,
            'id' => $marketplaceJob->id,
        ]));


        $response->assertStatus(400);
        $response->assertJson(ResponseFactoryTest::error('You have already proposed on this job.'));
        $this->document(self::DOC_PATH, self::ACCEPT_JOB_ROUTE, $response->status(), $response->getContent());
    }

    public function testWithdrawJob()
    {
        $marketplaceJob = $this->marketplaceJobRepository->find(2);
        $response = $this->post(route(self::WITHDRAW_JOB_ROUTE, [
            'unique_id' => $this->business->unique_id,
            'id' => $marketplaceJob->id,
        ]));

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('You have withdrawn from this job.'));
        $this->document(self::DOC_PATH, self::WITHDRAW_JOB_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::withdraw
     */
    public function testWithdrawJobFail()
    {
        $marketplaceJob = $this->marketplaceJobRepository->find(4);
        $response = $this->post(route(self::WITHDRAW_JOB_ROUTE, [
            'unique_id' => $this->business->unique_id,
            'id' => $marketplaceJob->id,
        ]));

        $response->assertStatus(400);
        $response->assertJson(ResponseFactoryTest::error('Illegal status transition.'));
        $this->document(self::DOC_PATH, self::WITHDRAW_JOB_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::arrive
     */
    public function testArrive()
    {
        $marketplaceJob = $this->marketplaceJobRepository->find(3);
        $response = $this->post(route(self::FREELANCER_ARRIVE_ROUTE, [
            'unique_id' => $this->business->unique_id,
            'id' => $marketplaceJob->id,
        ]));

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('Your customer has been notified of your arrival.'));
        $this->document(self::DOC_PATH, self::FREELANCER_ARRIVE_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::arrive
     */
    public function testArriveFail()
    {
        $marketplaceJob = $this->marketplaceJobRepository->find(4);
        $response = $this->post(route(self::FREELANCER_ARRIVE_ROUTE, [
            'unique_id' => $this->business->unique_id,
            'id' => $marketplaceJob->id,
        ]));

        $response->assertStatus(400);
        $response->assertJson(ResponseFactoryTest::error('Illegal status transition.'));
        $this->document(self::DOC_PATH, self::FREELANCER_ARRIVE_ROUTE, $response->status(), $response->getContent());
    }

    public function testComplete()
    {
        $marketplaceJob = $this->marketplaceJobRepository->find(4);
        $response = $this->post(route(self::FREELANCER_COMPLETE_ROUTE, [
            'unique_id' => $this->business->unique_id,
            'id' => $marketplaceJob->id,
        ]));

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('The customer has been notified of your completion'));
        $this->document(self::DOC_PATH, self::FREELANCER_COMPLETE_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::complete
     */
    public function testCompleteFail()
    {
        $marketplaceJob = $this->marketplaceJobRepository->find(3);
        $response = $this->post(route(self::FREELANCER_COMPLETE_ROUTE, [
            'unique_id' => $this->business->unique_id,
            'id' => $marketplaceJob->id,
        ]));

        $response->assertStatus(400);
        $response->assertJson(ResponseFactoryTest::error('Illegal status transition.'));
        $this->document(self::DOC_PATH, self::FREELANCER_COMPLETE_ROUTE, $response->status(), $response->getContent());
    }
}
