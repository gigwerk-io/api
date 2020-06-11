<?php

namespace Tests\Feature\Http\Controllers\User;

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
 * @coversDefaultClass \App\Http\Controllers\User\ProfileController
 */
class ProfileControllerTest extends TestCase
{
    const DOC_PATH = 'user/profile';
    const SHOW_PROFILE_ROUTE = 'show.user.profile';
    const UPDATE_PROFILE_ROUTE = 'update.user.profile';
    const SEARCH_USER_ROUTE = 'search.user';

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
    public function testShowUserProfile()
    {
        $response = $this->get(route(self::SHOW_PROFILE_ROUTE, ['unique_id' => $this->business->unique_id, 'user_id' => $this->admin->id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['username', 'marketplaceJobs', 'marketplaceProposals']]);
        $this->document(self::DOC_PATH, self::SHOW_PROFILE_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::update
     */
    public function testUpdateProfile()
    {
        $response = $this->patch(route(self::UPDATE_PROFILE_ROUTE),[
            'description' => 'Lorem Ipsum'
        ]);
        $response->assertStatus(200);
        $response->assertJson(ResponseFactoryTest::success('Profile has been updated'));
        $this->document(self::DOC_PATH, self::UPDATE_PROFILE_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::search
     */
    public function testSearchUser()
    {
        $response = $this->get(route(self::SEARCH_USER_ROUTE, ['unique_id' => $this->business->unique_id, 'search' => 'admin']));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['first_name', 'last_name', 'username']]]);
        $this->document(self::DOC_PATH, self::SEARCH_USER_ROUTE, $response->status(), $response->getContent());
    }
}
