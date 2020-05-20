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
    const REJECT_FREELANCER_ROUTE = 'reject.freelancer';
    const CANCEL_JOB_ROUTE = 'cancel.job';
    const REVIEW_JOB_ROUTE = 'review.job';

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
        $marketplaceJob = $this->marketplaceJobRepository->find(2);
        $response = $this->post(route(self::APPROVE_FREELANCER_ROUTE, [
            'unique_id' => $this->business->unique_id,
            'id' => $marketplaceJob->id,
            'freelancer_id' => $this->worker->id
        ]));

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('You have approved this worker'));
        $this->document(self::DOC_PATH, self::APPROVE_FREELANCER_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::approve
     */
    public function testApproveWorkerFail()
    {
        $marketplaceJob = $this->marketplaceJobRepository->find(3);
        $response = $this->post(route(self::APPROVE_FREELANCER_ROUTE, [
            'unique_id' => $this->business->unique_id,
            'id' => $marketplaceJob->id,
            'freelancer_id' => $this->worker->id
        ]));

        $response->assertStatus(400);
        $response->assertJson(ResponseFactoryTest::error('This worker does not have a proposal for this job.'));
        $this->document(self::DOC_PATH, self::APPROVE_FREELANCER_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::reject
     */
    public function testRejectWorker()
    {
        $marketplaceJob = $this->marketplaceJobRepository->find(2);
        $response = $this->post(route(self::REJECT_FREELANCER_ROUTE, [
            'unique_id' => $this->business->unique_id,
            'id' => $marketplaceJob->id,
            'freelancer_id' => $this->worker->id
        ]));

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('You have rejected this worker'));
        $this->document(self::DOC_PATH, self::REJECT_FREELANCER_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::reject
     */
    public function testRejectWorkerFail()
    {
        $marketplaceJob = $this->marketplaceJobRepository->find(3);
        $response = $this->post(route(self::REJECT_FREELANCER_ROUTE, [
            'unique_id' => $this->business->unique_id,
            'id' => $marketplaceJob->id,
            'freelancer_id' => $this->worker->id
        ]));

        $response->assertStatus(400);
        $response->assertJson(ResponseFactoryTest::error('This worker does not have a proposal for this job.'));
        $this->document(self::DOC_PATH, self::REJECT_FREELANCER_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::cancel
     */
    public function testCancelJob()
    {
        $marketplaceJob = $this->marketplaceJobRepository->find(1);
        $response = $this->delete(route(self::CANCEL_JOB_ROUTE, [
            'unique_id' => $this->business->unique_id,
            'id' => $marketplaceJob->id,
        ]));

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('Your request has been deleted.'));
        $this->document(self::DOC_PATH, self::CANCEL_JOB_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::cancel
     */
    public function testCancelJobFail()
    {
        $marketplaceJob = $this->marketplaceJobRepository->find(3);
        $response = $this->delete(route(self::CANCEL_JOB_ROUTE, [
            'unique_id' => $this->business->unique_id,
            'id' => $marketplaceJob->id,
        ]));

        $response->assertStatus(400);
        $response->assertJson(ResponseFactoryTest::error('You can not cancel a job that is in progress'));
        $this->document(self::DOC_PATH, self::CANCEL_JOB_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::review
     */
    public function testReviewJob()
    {
        $marketplaceJob = $this->marketplaceJobRepository->find(4);
        $response = $this->post(route(self::REVIEW_JOB_ROUTE, [
            'unique_id' => $this->business->unique_id,
            'id' => $marketplaceJob->id,
        ]), ['rating' => 5, 'review' => 'Worker did amazing!']);

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('This job has been marked review'));
        $this->document(self::DOC_PATH, self::REVIEW_JOB_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::review
     */
    public function testReviewJobFail()
    {
        $marketplaceJob = $this->marketplaceJobRepository->find(2);
        $response = $this->post(route(self::REVIEW_JOB_ROUTE, [
            'unique_id' => $this->business->unique_id,
            'id' => $marketplaceJob->id,
        ]), ['rating' => 5, 'review' => 'Worker did amazing!']);

        $response->assertStatus(400);
        $response->assertJson(ResponseFactoryTest::error('Illegal status transition.'));
        $this->document(self::DOC_PATH, self::REVIEW_JOB_ROUTE, $response->status(), $response->getContent());
    }
}
