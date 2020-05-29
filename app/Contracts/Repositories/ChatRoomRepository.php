<?php

namespace App\Contracts\Repositories;

use App\Models\ChatRoom;
use App\Models\User;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ChatRoomRepository.
 *
 * @package namespace App\Contracts\Repositories;
 */
interface ChatRoomRepository extends RepositoryInterface
{
    /**
     * @param User $user
     * @return self
     */
    public function whereParticipant(User $user);

    /**
     * @param User $userOne
     * @param User $userTwo
     * @return ChatRoom
     */
    public function findWhereUsers(User $userOne, User $userTwo);
}
