<?php

use App\Contracts\Repositories\ChatRoomRepository;
use App\Contracts\Repositories\UserRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Tests\Factories\ChatMessageFactory;

class DevChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var UserRepository $userRepository */
        $userRepository = app()->make(UserRepository::class);
        /** @var ChatRoomRepository $roomRepository */
        $roomRepository = app()->make(ChatRoomRepository::class);

        // Get the users
        $superAdmin = $userRepository->find(1);
        $worker = $userRepository->find(2);

        /** @var \App\Models\ChatRoom $room */
        $room = $roomRepository->create([
            'id' => Str::uuid(),
            'users' => [$superAdmin->username, $worker->username],
            'business_id' => 1
        ]);

        $room->messages()->saveMany([
            ChatMessageFactory::new()->make(['sender_id' => $superAdmin->id, 'chat_room_id' => $room->id]),
            ChatMessageFactory::new()->make(['sender_id' => $worker->id, 'chat_room_id' => $room->id])
        ]);
    }
}
