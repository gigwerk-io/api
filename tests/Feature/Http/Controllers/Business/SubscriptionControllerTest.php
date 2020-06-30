<?php

namespace Tests\Feature\Http\Controllers\Business;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\UserRepository;
use App\Enum\Billing\Plan;
use App\Models\Business;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\ResponseFactoryTest;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\Business\SubscriptionController
 */
class SubscriptionControllerTest extends TestCase
{
    const DOC_PATH = 'business/subscription';
    const SHOW_SUBSCRIPTION_ROUTE = 'show.subscription.plan';
    const UPDATE_SUBSCRIPTION_ROUTE = 'update.subscription.plan';
    const REMOVE_SUBSCRIPTION_ROUTE = 'cancel.subscription.plan';

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
     * @covers ::show
     */
    public function testShowSubscriptionPlan()
    {
        $response = $this->get(route(self::SHOW_SUBSCRIPTION_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['items', 'stripe_plan', 'ends_at', 'stripe_status']]);
        $this->document(self::DOC_PATH, self::SHOW_SUBSCRIPTION_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::update
     */
    public function testChangeSubscriptionPlan()
    {
        self::markTestIncomplete();
        $response = $this->patch(route(self::UPDATE_SUBSCRIPTION_ROUTE, [
            'unique_id' => $this->business->unique_id,
        ]), ['subscription_id' => Plan::BASIC['id']]);

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('You are now subscribed to the Basic Plan.'));
        $this->document(self::DOC_PATH, self::UPDATE_SUBSCRIPTION_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::delete
     */
    public function testCancelSubscriptionPlan()
    {
        $response = $this->delete(route(self::REMOVE_SUBSCRIPTION_ROUTE, [
            'unique_id' => $this->business->unique_id,
        ]));

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('You have cancelled your subscription.'));
        $this->document(self::DOC_PATH, self::REMOVE_SUBSCRIPTION_ROUTE, $response->status(), $response->getContent());
    }
}
