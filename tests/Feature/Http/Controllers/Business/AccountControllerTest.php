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
 * @coversDefaultClass \App\Http\Controllers\Business\AccountController
 */
class AccountControllerTest extends TestCase
{
    const DOC_PATH = 'business/account';
    const ACCOUNT_UPDATE_ROUTE = 'update.business.account';
    const LOCATION_UPDATE_ROUTE = 'update.business.location';
    const STRIPE_LOGIN_ROUTE = 'business.stripe.login';
    const VIEW_ACCOUNT_ROUTE = 'show.account';

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
    public function testShowAccount()
    {
        $response = $this->get(route(self::VIEW_ACCOUNT_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['name', 'profile', 'location']]);
        $this->document(self::DOC_PATH, self::VIEW_ACCOUNT_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::updateProfile
     */
    public function testUpdateProfile()
    {
        $response = $this->patch(route(self::ACCOUNT_UPDATE_ROUTE, ['unique_id' => $this->business->unique_id]), [
            'name' => 'Foobar',
            'short_description' => 'Goofy Goober'
        ]);

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('Your business has been updated'));
        $this->document(self::DOC_PATH, self::ACCOUNT_UPDATE_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::updateLocation
     */
    public function testUpdateLocation()
    {
        $response = $this->patch(route(self::LOCATION_UPDATE_ROUTE, ['unique_id' => $this->business->unique_id]), [
            'street_addres' => '312 Main Street'
        ]);


        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('Your business location has been updated'));
        $this->document(self::DOC_PATH, self::LOCATION_UPDATE_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::stripeLogin
     */
    public function testStripeLogin()
    {
        $response = $this->get(route(self::STRIPE_LOGIN_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['url']]);
        $this->document(self::DOC_PATH, self::STRIPE_LOGIN_ROUTE, $response->status(), $response->getContent());
    }


}
