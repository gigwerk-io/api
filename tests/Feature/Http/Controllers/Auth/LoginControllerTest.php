<?php

namespace Tests\Feature\Http\Controllers\Auth;

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
 * @coversDefaultClass \App\Http\Controllers\Auth\LoginController
 */
class LoginControllerTest extends TestCase
{
    const DOC_PATH = 'auth/login';
    const LOGIN_ROUTE = 'login';
    const BUSINESS_LOGIN_ROUTE = 'business.login';
    const LOGOUT_ROUTE = 'logout';
    const VALIDATE_ROUTE = 'validate';
    const VALIDATE_BUSINESS_TOKEN = 'business.validate';

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
        // Get Primary User
        $this->user = $this->app
            ->make(UserRepository::class)
            ->find(1);
        // first business
        $this->business = $this->app->make(BusinessRepository::class)->find(1);
    }

    /**
     * @covers ::login
     */
    public function testLogin()
    {
        $response = $this->post(route(self::LOGIN_ROUTE), [
            'username' => $this->user->username,
            'password' => 'password'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['token', 'user' => ['profile']]]);
        $this->document(self::DOC_PATH, self::LOGIN_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::businessLogin
     */
    public function testBusinessLogin()
    {
        $response = $this->post(route(self::BUSINESS_LOGIN_ROUTE, ['unique_id' => $this->business->unique_id]), [
            'username' => $this->user->username,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['token', 'user' => ['profile']]]);
        $this->document(self::DOC_PATH, self::BUSINESS_LOGIN_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::logout
     */
    public function testLogout()
    {
        Sanctum::actingAs($this->user);

        $response = $this->post(self::LOGOUT_ROUTE);
        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('User has been logged out.'));
        $this->document(self::DOC_PATH, self::LOGOUT_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::tokenValidation
     */
    public function testValidateToken()
    {
        Sanctum::actingAs($this->user);

        $response = $this->get(self::VALIDATE_ROUTE);
        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('Token is valid.', ['validToken' => true]));
        $this->document(self::DOC_PATH, self::VALIDATE_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::tokenValidation
     */
    public function testValidateExpiredToken()
    {
        $response = $this->get(self::VALIDATE_ROUTE);
        $response->assertStatus(400);
        $response->assertJson(ResponseFactoryTest::error('Token is not valid.', ['validToken' => false]));
        $this->document(self::DOC_PATH, self::VALIDATE_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::businessTokenValidation
     */
    public function testValidateBusinessToken()
    {
        Sanctum::actingAs($this->user, [$this->business->unique_id]);

        $response = $this->get(route(self::VALIDATE_BUSINESS_TOKEN, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('You have access to this business.', ['validToken' => true]));
        $this->document(self::DOC_PATH, self::VALIDATE_BUSINESS_TOKEN, $response->status(), $response->getContent());
    }
}
