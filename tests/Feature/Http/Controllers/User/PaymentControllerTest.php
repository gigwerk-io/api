<?php

namespace Tests\Feature\Http\Controllers\User;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\UserRepository;
use App\Models\Business;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\User\PaymentController
 */
class PaymentControllerTest extends TestCase
{
    const DOC_PATH = 'user/payment';
    const ALL_PAYMENTS_ROUTE = 'all.user.payments';
    const SHOW_PAYMENT_ROUTE = 'show.user.payment';

    /**
     * @var User
     */
    private $user;

    /**
     * @var Business
     */
    private $business;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->app->make(UserRepository::class)->find(1);
        // Get the business
        $this->business = $this->app->make(BusinessRepository::class)->find(1);
        Sanctum::actingAs($this->user);
    }

    /**
     * @covers ::index
     */
    public function testViewPayments()
    {
        $response = $this->get(route(self::ALL_PAYMENTS_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['marketplace_id', 'user_id', 'amount', 'stripe_token']]]);
        $this->document(self::DOC_PATH, self::ALL_PAYMENTS_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::show
     */
    public function testShowPayment()
    {
        $response = $this->get(route(self::SHOW_PAYMENT_ROUTE, ['unique_id' => $this->business->unique_id, 'id' => 1]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['user_id', 'amount', 'stripe_token']]);
        $this->document(self::DOC_PATH, self::SHOW_PAYMENT_ROUTE, $response->status(), $response->getContent());
    }
}
