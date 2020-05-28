<?php

namespace App\Http\Controllers\Chat;

use App\Annotation\Group;
use App\Annotation\Meta;
use App\Contracts\Repositories\ChatRoomRepository;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @Group(name="Message", description="Manage the messages for users")
 */
class MessageController extends Controller
{
    /**
     * @var ChatRoomRepository
     */
    private $chatRoomRepository;

    public function __construct(ChatRoomRepository $chatRoomRepository)
    {
        $this->chatRoomRepository = $chatRoomRepository;
    }

    /**
     * @Meta(name="Send Message", description="Send a message to another user.", href="send-message")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        /** @var Business $business */
        $business = $request->get('business');
        $this->validate($request, [
            'message' => 'required',
            'room_id' => ['required', 'exists:chat_rooms,id']
        ]);

        /** @var ChatRoom $room */
        $room = $this->chatRoomRepository->with('messages.sender.profile')
            ->whereParticipant($user)
            ->findWhere(['id' => $request->room_id, 'business_id' => $business->id])
            ->first();

        if (is_null($room)) {
            return ResponseFactory::error(
                'Chat room does not exist',
                null,
                404
            );
        }

        $room->touch();
        $message = $room->messages()->create([
            'sender_id' => $this->user->id,
            'text' => $request->message
        ]);

        // $this->eventDispatcher->dispatch()
        return ResponseFactory::success('Message sent', $message, 201);
    }
}
