<?php

namespace App\Http\Controllers\User;

use App\Annotation\Group;
use App\Contracts\Repositories\ChatMessageRepository;
use App\Contracts\Repositories\ChatRoomRepository;
use App\Contracts\Repositories\UserRepository;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\User;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;

/**
 * @Group(name="Chat", description="These routes belong are responsible for managing the user chat system.")
 */
class ChatController extends Controller
{
    /**
     * @var Dispatcher
     */
    private $eventDispatcher;

    /**
     * @var ChatRoomRepository
     */
    private $chatRoomRepository;

    /**
     * @var ChatMessageRepository
     */
    private $chatMessageRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(
        Dispatcher $eventDispatcher,
        ChatRoomRepository $chatRoomRepository,
        ChatMessageRepository $chatMessageRepository,
        UserRepository $userRepository
    )
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->chatRoomRepository = $chatRoomRepository;
        $this->chatMessageRepository = $chatMessageRepository;
        $this->userRepository = $userRepository;
    }

    public function sendMessage($uuid, Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        /** @var Business $business */
        $business = $request->get('business');
        $this->validate($request, [
            'message' => 'required'
        ]);

        $room = $this->chatRoomRepository->with('messages.sender.profile')
            ->whereParticipant($user)
            ->findWhere(['id' => $uuid, 'business_id' => $business->id])
            ->first();

        if (is_null($room)) {
            return ResponseFactory::error(
                'Chat room does not exist',
                null,
                404
            );
        }

        $room->touch();
    }
}
