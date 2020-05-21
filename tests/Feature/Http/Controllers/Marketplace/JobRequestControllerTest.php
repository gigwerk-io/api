<?php

namespace Tests\Feature\Http\Controllers\Marketplace;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\MarketplaceJobRepository;
use App\Contracts\Repositories\UserRepository;
use App\Models\Business;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\Factories\MarketplaceJobFactory;
use Tests\Factories\MarketplaceLocationFactory;
use Tests\ResponseFactoryTest;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\Marketplace\JobRequestController
 */
class JobRequestControllerTest extends TestCase
{
    const DOC_PATH = 'marketplace/request';
    const SUBMIT_JOB_ROUTE = 'submit.job';
    const EDIT_JOB_ROUTE = 'edit.job';

    /**
     * @var User
     */
    private $customer;

    /**
     * @var Business
     */
    private $business;

    protected function setUp(): void
    {
        parent::setUp();
        $this->customer = $this->app->make(UserRepository::class)->find(1);
        // Get the business
        $this->business = $this->app->make(BusinessRepository::class)->find(1);
        Sanctum::actingAs($this->customer);
    }

    /**
     * @covers ::submit
     */
    public function testSubmitJob()
    {
        $marketplaceJob = MarketplaceJobFactory::new()->make();
        $location = MarketplaceLocationFactory::new()->make();
        $response = $this->post(route(self::SUBMIT_JOB_ROUTE, ['unique_id' => $this->business->unique_id]), [
            'description' => $marketplaceJob->description,
            'complete_before' => Carbon::now()->toDateTimeString(),
            'street_address' => $location->street_address,
            'city' => $location->city,
            'state' => $location->state,
            'zip' => $location->zip,
            'category_id' => 1,
            'intensity_id' => 2,
            'price' => 25,
            'image_one' => file_get_contents(storage_path('test/base64-image.txt'))
        ]);


        $response->assertStatus(201);
        $response->assertJsonStructure(['data' => ['category_id', 'status_id', 'customer_id']]);
        $this->document(self::DOC_PATH, self::SUBMIT_JOB_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::edit
     */
    public function testEditJob()
    {
        $marketplaceJob = $this->app->make(MarketplaceJobRepository::class)->find(1);
        $response = $this->patch(route(self::EDIT_JOB_ROUTE, ['unique_id' => $this->business->unique_id, 'id' => $marketplaceJob->id]), [
            'description' => 'foo bar',
        ]);


        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('Your job has been updated.'));
        $this->document(self::DOC_PATH, self::EDIT_JOB_ROUTE, $response->status(), $response->getContent());
    }
}
