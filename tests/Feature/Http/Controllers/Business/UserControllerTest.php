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
 * @coversDefaultClass \App\Http\Controllers\Business\UserController
 */
class UserControllerTest extends TestCase
{
    const DOC_PATH = 'business/user';
    const ALL_USERS_ROUTE = 'business.all.users';
    const SHOW_USER_ROUTE = 'business.show.user';
    const UPDATE_USER_ROUTE = 'business.update.user';
    const REMOVE_USER_ROUTE = 'business.remove.user';

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
    public function testViewAllUsers()
    {
        $response = $this->get(route(self::ALL_USERS_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['email', 'profile', 'pivot']]]);
        $this->document(self::DOC_PATH, self::ALL_USERS_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::show
     */
    public function testShowUser()
    {
        $response = $this->get(route(self::SHOW_USER_ROUTE, ['unique_id' => $this->business->unique_id, 'id' => 2]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['email', 'profile', 'pivot', 'marketplace_jobs', 'marketplace_proposals']]);
        $this->document(self::DOC_PATH, self::SHOW_USER_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::update
     */
    public function testUpdateUserRole()
    {
        $response = $this->patch(route(self::UPDATE_USER_ROUTE, ['unique_id' => $this->business->unique_id, 'id' => 2]), [
            'role_id' => 3
        ]);

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('This users role has been updated.'));
        $this->assertDatabaseHas('business_user', ['business_id' => $this->business->id, 'user_id' => 2, 'role_id' => 3]);
        $this->document(self::DOC_PATH, self::UPDATE_USER_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::delete
     */
    public function testRemoveUser()
    {
        $response = $this->delete(route(self::REMOVE_USER_ROUTE, ['unique_id' => $this->business->unique_id, 'id' => 2]));

        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('This user has been removed from your business.'));
        $this->assertDatabaseMissing('business_user', ['business_id' => $this->business->id, 'user_id' => 2]);
        $this->document(self::DOC_PATH, self::REMOVE_USER_ROUTE, $response->status(), $response->getContent());
    }
}
