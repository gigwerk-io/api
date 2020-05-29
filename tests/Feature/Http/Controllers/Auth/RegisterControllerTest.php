<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\UserRepository;
use App\Events\User\Registered;
use App\Events\User\UserHasRegistered;
use App\Models\Business;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Tests\Factories\BusinessFactory;
use Tests\Factories\BusinessLocationFactory;
use Tests\Factories\UserFactory;
use Tests\Factories\UserProfileFactory;
use Tests\ResponseFactoryTest;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\Auth\RegisterController
 */
class RegisterControllerTest extends TestCase
{
    const DOC_PATH = 'auth/register';
    const USER_REGISTER_ROUTE = 'user.registration';
    const BUSINESS_REGISTER_ROUTE = 'business.registration';
    const JOIN_BUSINESS_ROUTE = 'join.business';

    /**
     * @covers ::userRegistration
     */
    public function testRegisterUser()
    {
        $this->expectsEvents(Registered::class);
        $str = Str::random(10);
        $user = UserFactory::new()->withAttributes(['username' => $str, 'email' => $str . '@mail.com'])->make();
        $response = $this->post(route(self::USER_REGISTER_ROUTE), [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'username' => $user->username,
            'email' => $user->email,
            'phone' => $user->phone,
            'password' => 'secret',
        ]);
        $response->assertStatus(201);
        $response->assertJsonStructure(['data' => ['user' => ['profile']]]);
        $this->assertDatabaseHas('users', ['username' => $user->username]);
        $this->document(self::DOC_PATH, self::USER_REGISTER_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::businessRegistration
     */
    public function testBusinessRegister()
    {
        $admin = $this->app->make(UserRepository::class)->find(1);
        $business = BusinessFactory::new()->make();
        $location = BusinessLocationFactory::new()->make();
        Sanctum::actingAs($admin);

        $response = $this->post(route(self::BUSINESS_REGISTER_ROUTE), [
            'name' => $business->name,
            'subdomain_prefix' => $business->subdomain_prefix,
            'street_address' => $location->street_address,
            'city' => $location->city,
            'state' => $location->state,
            'zip' => $location->zip
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['data' => ['profile', 'location']]);
        $this->assertDatabaseHas('businesses', ['name' => $business->name]);
        $this->document(self::DOC_PATH, self::BUSINESS_REGISTER_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::joinBusiness
     */
    public function testJoinBusinessMarketplace()
    {
        $user = UserFactory::new()->withProfile(UserProfileFactory::new())->create();
        $business = $this->app->make(BusinessRepository::class)->find(1);
        Sanctum::actingAs($user);

        $response = $this->post(route(self::JOIN_BUSINESS_ROUTE, ['unique_id' => $business->unique_id]));

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('Your application has been sent'));
        $this->document(self::DOC_PATH, self::JOIN_BUSINESS_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::joinBusiness
     */
    public function testJoinBusinessWhereAlreadyMember()
    {
        $applicant = $this->app->make(UserRepository::class)->find(2);
        $business = $this->app->make(BusinessRepository::class)->find(1);
        Sanctum::actingAs($applicant);

        $response = $this->post(route(self::JOIN_BUSINESS_ROUTE, ['unique_id' => $business->unique_id]));

        $response->assertStatus(400);
        $response->assertJson(ResponseFactoryTest::error('You are already a member of this business marketplace'));
        $this->document(self::DOC_PATH, self::JOIN_BUSINESS_ROUTE, $response->status(), $response->getContent());
    }
}
