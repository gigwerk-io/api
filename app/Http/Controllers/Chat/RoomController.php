<?php

namespace App\Http\Controllers\Chat;

use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;
use App\Contracts\Repositories\ChatRoomRepository;
use App\Contracts\Repositories\UserRepository;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * @Group(name="Room", description="Manage a user's chat rooms.")
 */
class RoomController extends Controller
{
    /**
     * @var ChatRoomRepository
     */
    private $chatRoomRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(ChatRoomRepository $chatRoomRepository, UserRepository $userRepository)
    {
        $this->chatRoomRepository = $chatRoomRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @Meta(name="All Chat Rooms", description="View a list of a user's chat rooms.", href="all-rooms")
     * @ResponseExample(status=200, example="responses/chat/all.chat.rooms-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $rooms = $this->chatRoomRepository->with('messages')
            ->orderBy('updated_at', 'desc')
            ->whereParticipant($user)
            ->get();

        $rooms->map(function ($room) use ($user) {
            $room->unread = $room->messages->where('sender_id', '!=', $user)->where('read', '=', false)->count();
        });

        return ResponseFactory::success('Show chat rooms', $rooms);
    }

    /**
     * @Meta(name="View Chat Room", description="View a single chat room", href="single-room")
     * @ResponseExample(status=200, example="responses/chat/single.chat.room-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function show(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        $this->validate($request, ['room_id' => ['exists:chat_rooms,id']]);

        /** @var ChatRoom $room */
        $room = $this->chatRoomRepository->with('messages.sender.profile')
            ->whereParticipant($user)
            ->find($request->room_id);

        // Set messages to read
        $room->messages()->where('read', '=', false)
            ->where('sender_id', '!=', $user->id)
            ->update(['read' => true]);

        return ResponseFactory::success(
            'View chat room',
            $room
        );
    }

    /**
     * @Meta(name="Create Chat Room", description="Find or create a chat room between two users.", href="create-room")
     * @ResponseExample(status=200, example="responses/chat/find.chat.room-200.json")
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
            'username' => ['exists:users,username']
        ]);

        $other = $this->userRepository->whereHas('businesses', function ($query) use ($business){
            $query->where('id', '=', $business->id);
        })->findByField('username', $request->username)->first();

        if (is_null($other)) {
            return ResponseFactory::error(
                'User not found.',
                null,
                404
            );
        }

        if ($user->id == $other->id) {
            return ResponseFactory::error(
                'User can not create a chat room with themselves.'
            );
        }


        $room = $this->chatRoomRepository->findWhereUsers($user, $other);

        if (!is_null($room)) {
            return ResponseFactory::success('Find chat room', ['id' => $room->id]);
        }

        $data['id'] = Str::uuid();
        $data['users'] = [$user->username, $other->username];
        $data['business_id'] = $business->id;
        $room = $this->chatRoomRepository->create($data);

        return ResponseFactory::success('Find chat room', ['id' => $room->id]);
    }
}
