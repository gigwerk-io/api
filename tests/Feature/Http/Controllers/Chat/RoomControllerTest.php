<?php

namespace Tests\Feature\Http\Controllers\Chat;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\ChatRoomRepository;
use App\Contracts\Repositories\UserRepository;
use App\Models\Business;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\Chat\RoomController
 */
class RoomControllerTest extends TestCase
{
    const DOC_PATH = 'chat';
    const ALL_ROOMS_ROUTE = 'all.chat.rooms';
    const SINGLE_ROOM_ROUTE = 'single.chat.room';
    const FIND_ROOM_ROUTE = 'find.chat.room';

    /**
     * @var User
     */
    private $admin;

    /**
     * @var User
     */
    private $worker;

    /**
     * @var Business
     */
    private $business;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = $this->app->make(UserRepository::class)->find(1);
        $this->worker = $this->app->make(UserRepository::class)->find(2);
        // Get the business
        $this->business = $this->app->make(BusinessRepository::class)->find(1);
        Sanctum::actingAs($this->admin);
    }

    /**
     * @covers ::index
     */
    public function testViewAllChatRooms()
    {
        $response = $this->get(route(self::ALL_ROOMS_ROUTE, ['unique_id' => $this->business->unique_id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['messages', 'unread', 'users']]]);
        $this->document(self::DOC_PATH, self::ALL_ROOMS_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::show
     */
    public function testShowChatRoom()
    {
        $room = $this->app->make(ChatRoomRepository::class)->all()->first();
        $response = $this->get(route(self::SINGLE_ROOM_ROUTE, ['unique_id' => $this->business->unique_id, 'room_id' => $room->id]));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['messages', 'users']]);
        $this->document(self::DOC_PATH, self::SINGLE_ROOM_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::store
     */
    public function testFindChatRoom()
    {
        $response = $this->get(route(self::FIND_ROOM_ROUTE, ['unique_id' => $this->business->unique_id, 'username' => 'pending_one']));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['id']]);
        $this->document(self::DOC_PATH, self::FIND_ROOM_ROUTE, $response->status(), $response->getContent());
    }
}
