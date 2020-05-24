<?php

namespace Tests\Feature\Http\Controllers\Business;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\UserRepository;
use App\Models\Business;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\ResponseFactoryTest;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\Business\ApplicantController
 */
class ApplicantControllerTest extends TestCase
{
    const DOC_PATH = 'business/applicant';
    const ALL_APPLICANTS_ROUTE = 'all.applicants';
    const SHOW_APPLICANT_ROUTE = 'show.applicant';
    const APPROVE_APPLICANT_ROUTE = 'approve.applicant';
    const REJECT_APPLICANT_ROUTE = 'reject.applicant';
    const DELETE_APPLICATION_ROUTE = 'delete.application';

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
    public function testViewAllApplicants()
    {
        $response = $this->get(route(self::ALL_APPLICANTS_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['status', 'user']]]);
        $this->document(self::DOC_PATH, self::ALL_APPLICANTS_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::show
     */
    public function testShowApplicant()
    {
        $response = $this->get(route(self::SHOW_APPLICANT_ROUTE, ['unique_id' => $this->business->unique_id, 'id' => 3]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['status', 'user']]);
        $this->document(self::DOC_PATH, self::SHOW_APPLICANT_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::approve
     */
    public function testApproveApplicant()
    {
        $response = $this->post(route(self::APPROVE_APPLICANT_ROUTE, ['unique_id' => $this->business->unique_id, 'id' => 3]));

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('This application has been approved'));
        $this->assertDatabaseHas('business_user', ['user_id' => 4, 'business_id' => 1]);
        $this->document(self::DOC_PATH, self::APPROVE_APPLICANT_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::approve
     */
    public function testApproveApplicantFail()
    {
        $response = $this->post(route(self::APPROVE_APPLICANT_ROUTE, ['unique_id' => $this->business->unique_id, 'id' => 2]));

        $response->assertStatus(400);
        $response->assertJson(ResponseFactoryTest::error('This user has already joined your business'));
        $this->document(self::DOC_PATH, self::APPROVE_APPLICANT_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::reject
     */
    public function testRejectApplicant()
    {
        $response = $this->post(route(self::REJECT_APPLICANT_ROUTE, ['unique_id' => $this->business->unique_id, 'id' => 3]));

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('This application has been rejected'));
        $this->document(self::DOC_PATH, self::REJECT_APPLICANT_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::reject
     */
    public function testRejectApplicantFail()
    {
        $response = $this->post(route(self::REJECT_APPLICANT_ROUTE, ['unique_id' => $this->business->unique_id, 'id' => 2]));

        $response->assertStatus(400);
        $response->assertJson(ResponseFactoryTest::error('This user has already joined your business'));
        $this->document(self::DOC_PATH, self::REJECT_APPLICANT_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::delete
     */
    public function testDeleteApplication()
    {
        $response = $this->delete(route(self::DELETE_APPLICATION_ROUTE, ['unique_id' => $this->business->unique_id, 'id' => 3]));

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('This application has been removed'));
        $this->document(self::DOC_PATH, self::DELETE_APPLICATION_ROUTE, $response->status(), $response->getContent());
    }
}
