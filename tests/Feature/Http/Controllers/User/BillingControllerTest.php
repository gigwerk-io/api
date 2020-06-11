<?php

namespace Tests\Feature\Http\Controllers\User;

use App\Contracts\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Stripe\Stripe;
use Stripe\Token;
use Tests\Factories\PaymentMethodFactory;
use Tests\ResponseFactoryTest;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\User\BillingController
 */
class BillingControllerTest extends TestCase
{
    const DOC_PATH = 'user/billing';
    const ALL_CARDS_ROUTE = 'all.payment.methods';
    const SHOW_CARD_ROUTE = 'show.payment.method';
    const STORE_CARD_ROUTE = 'store.payment.method';
    const UPDATE_CARD_ROUTE = 'update.payment.method';
    const DELETE_CARD_ROUTE = 'delete.payment.method';

    /**
     * @var User
     */
    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->app->make(UserRepository::class)->find(1);
        Sanctum::actingAs($this->user);
    }

    /**
     * @covers ::index
     */
    public function testViewCards()
    {
        $response = $this->get(route(self::ALL_CARDS_ROUTE));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['stripe_customer_id', 'stripe_card_id']]]);
        $this->document(self::DOC_PATH, self::ALL_CARDS_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::show
     */
    public function testShowCard()
    {
        $response = $this->get(route(self::SHOW_CARD_ROUTE, ['id' => 1]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['stripe_customer_id', 'stripe_card_id']]);
        $this->document(self::DOC_PATH, self::SHOW_CARD_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::store
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function testStoreCard()
    {
        Stripe::setApiKey(config('stripe.secret'));
        $token = Token::create([[
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => '12',
                'exp_year' => '2023',
                'cvc' => '123',
            ],
        ]]);

        $response = $this->post(route(self::STORE_CARD_ROUTE), ['token' => $token->id]);

        $response->assertStatus(201);
        $response->assertJson(ResponseFactoryTest::success('Your card has been saved.'));
        $this->document(self::DOC_PATH, self::STORE_CARD_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::update
     */
    public function testMakeDefault()
    {
        $response = $this->patch(route(self::UPDATE_CARD_ROUTE, ['id' => 1]));

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('Default payment method has been saved.'));
        $this->document(self::DOC_PATH, self::UPDATE_CARD_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::delete
     */
    public function testRemoveCard()
    {
        // make a second payment method
        $this->user->paymentMethods()->create(PaymentMethodFactory::new()->make()->toArray());

        $response = $this->delete(route(self::DELETE_CARD_ROUTE, ['id' => 1]));

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('This payment method has been removed.'));
        $this->document(self::DOC_PATH, self::DELETE_CARD_ROUTE, $response->status(), $response->getContent());
    }
}
