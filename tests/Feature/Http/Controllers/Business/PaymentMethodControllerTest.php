<?php

namespace Tests\Feature\Http\Controllers\Business;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\UserRepository;
use App\Models\Business;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Cashier\PaymentMethod;
use Laravel\Sanctum\Sanctum;
use Stripe\StripeClient;
use Tests\ResponseFactoryTest;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\Business\PaymentMethodController
 */
class PaymentMethodControllerTest extends TestCase
{
    const DOC_PATH = 'business/payment-method';
    const ALL_PAYMENT_METHODS_ROUTE = 'show.all.payment.methods';
    const SAVE_PAYMENT_METHOD_ROUTE = 'save.payment.method';
    const UPDATE_PAYMENT_METHOD_ROUTE = 'update.default.payment.method';
    const REMOVE_PAYMENT_METHOD_ROUTE = 'remove.payment.method';

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
    public function testShowPaymentMethods()
    {
        $response = $this->get(route(self::ALL_PAYMENT_METHODS_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['id', 'card', 'billing_details']]]);
        $this->document(self::DOC_PATH, self::ALL_PAYMENT_METHODS_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::store
     */
    public function testStorePaymentMethod()
    {
        $paymentMethod = $this->createPaymentMethod();
        $response = $this->post(route(self::SAVE_PAYMENT_METHOD_ROUTE, ['unique_id' => $this->business->unique_id]), [
            'payment_method_id' => $paymentMethod->id
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment(['message' => 'Payment method has been saved.']);
        $this->document(self::DOC_PATH, self::SAVE_PAYMENT_METHOD_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::update
     */
    public function testSetDefaultPaymentMethod()
    {
        /** @var PaymentMethod $paymentMethod */
        $paymentMethod = $this->business->paymentMethods()->first()->asStripePaymentMethod();

        $response = $this->patch(route(self::UPDATE_PAYMENT_METHOD_ROUTE, [
            'unique_id' => $this->business->unique_id,
            'payment_method_id' => $paymentMethod->id
        ]));

        $response->assertStatus(200);
        $response->assertJsonFragment(['message' => 'Your default payment method has been updated.']);
        $this->document(self::DOC_PATH, self::UPDATE_PAYMENT_METHOD_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::delete
     */
    public function testRemovePaymentMethod()
    {
        /** @var PaymentMethod $paymentMethod */
        $paymentMethod = $this->business->paymentMethods()->first()->asStripePaymentMethod();

        $response = $this->delete(route(self::REMOVE_PAYMENT_METHOD_ROUTE, [
            'unique_id' => $this->business->unique_id,
            'payment_method_id' => $paymentMethod->id
        ]));

        $response->assertStatus(200);
        $response->assertJsonFragment(['message' => 'This payment method has been removed.']);
        $this->document(self::DOC_PATH, self::REMOVE_PAYMENT_METHOD_ROUTE, $response->status(), $response->getContent());
    }


    /**
     * @return \Stripe\PaymentMethod
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Stripe\Exception\ApiErrorException
     */
    private function createPaymentMethod()
    {
        /** @var StripeClient $stripe */
        $stripe = $this->app->make(StripeClient::class);

        return $stripe->paymentMethods->create([
            'type' => 'card',
            'card' => [
                'number' => '6011111111111117',
                'exp_month' => 6,
                'exp_year' => 2022,
                'cvc' => '314',
            ],
        ]);
    }
}
