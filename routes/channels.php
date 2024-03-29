<?php

use App\Contracts\Repositories\ChatRoomRepository;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// All user notifications
Broadcast::channel('users.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});

Broadcast::channel('marketplace.{uuid}', function (User $user, $uuid) {
    return $user->businesses()->where('unique_id', '=', $uuid)->exists();
});

// Notifications to Dragon app
Broadcast::channel('dragon.{uuid}', function (User $user, $uuid) {
    return $user->businesses()->where('unique_id', '=', $uuid)
        ->where('owner_id', '=', $user->id)
        ->exists();
});

// Notification to Chat room
Broadcast::channel('chat.{id}', function (User $user, $id) {
    /** @var ChatRoomRepository $chat */
    $chat = app()->make(ChatRoomRepository::class);
    return !is_null($chat->whereParticipant($user)->find($id));
});
