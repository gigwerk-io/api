<?php

namespace Tests\Feature\Http\Controllers\Chat;

use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\ChatRoomRepository;
use App\Contracts\Repositories\UserRepository;
use App\Models\Business;
use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\Chat\MessageController
 */
class MessageControllerTest extends TestCase
{
    const DOC_PATH = 'chat';
    const SEND_MESSAGE_ROUTE = 'send.message';

    /**
     * @var User
     */
    private $admin;

    /**
     * @var ChatRoom
     */
    private $room;

    /**
     * @var Business
     */
    private $business;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = $this->app->make(UserRepository::class)->find(1);
        $this->room = $this->app->make(ChatRoomRepository::class)
            ->whereParticipant($this->admin)
            ->get()
            ->first();

        $this->business = $this->app->make(BusinessRepository::class)->find(1);

        Sanctum::actingAs($this->admin);
    }

    /**
     * @covers ::store
     */
    public function testSendMessage()
    {
        $response =  $this->post(route(self::SEND_MESSAGE_ROUTE, ['unique_id' => $this->business->unique_id, 'room_id' => $this->room->id]), [
            'message' => 'Foo bar'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('chat_messages', ['text' => 'Foo bar', 'chat_room_id' => $this->room->id]);
        $this->document(self::DOC_PATH, self::SEND_MESSAGE_ROUTE, $response->status(), $response->getContent());
    }
}
