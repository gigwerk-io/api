<?php

namespace Tests\Feature\Http\Controllers\User;

use App\Contracts\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\ResponseFactoryTest;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\User\ConnectController
 */
class ConnectControllerTest extends TestCase
{
    const DOC_PATH = 'user/connect';
    const STRIPE_LOGIN_ROUTE = 'stripe.user.login';
    const STRIPE_CREATE_ROUTE = 'save.stripe.account';

    /**
     * @var User
     */
    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->app->make(UserRepository::class)->find(2);
        Sanctum::actingAs($this->user);
    }

    /**
     * @covers ::show
     */
    public function testShowStripeAccount()
    {
        $response = $this->get(route(self::STRIPE_LOGIN_ROUTE));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['url']]);
        $this->document(self::DOC_PATH, self::STRIPE_LOGIN_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::store
     */
    public function testCreateStripeAccountFail()
    {
        $response = $this->get(route(self::STRIPE_CREATE_ROUTE, ['code' => 'foo', 'state' => 'bar']));
        $response->assertJson(ResponseFactoryTest::error('Something went wrong. Please try again later.'));
    }
}
