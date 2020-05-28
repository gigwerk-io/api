<?php

namespace App\Http\Controllers\Chat;

use App\Annotation\Group;
use App\Annotation\Meta;
use App\Contracts\Repositories\ChatRoomRepository;
use App\Contracts\Repositories\UserRepository;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Http\Request;

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
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function show(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        $this->validate($request, ['room_id' => ['required', 'exists:chat_rooms,id']]);

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
            'username' => ['required', 'exists:users,username']
        ]);

        $other = $this->userRepository->whereHas('business', function ($query) use ($business){
            $query->where('id', '=', $business->id);
        })->findByField('username', $request->username)->first();

        if ($user->id == $other->id) {
            return ResponseFactory::error(
                'User can not create a chat room with themselves.'
            );
        }

        $room = $this->chatRoomRepository->findWhereUsers($user, $other);

        if (!is_null($room)) {
            return ResponseFactory::success('Find chat room', ['id' => $room->id]);
        }

        $data['users'] = [$user->username, $other->username];
        $room = $this->chatRoomRepository->create($data);

        return ResponseFactory::success('Find chat room', ['id' => $room->id]);
    }
}
