<?php

namespace App\Criteria\Chat;

use App\Models\User;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class RoomUsersCriteria.
 *
 * @package namespace App\Criteria\Chat;
 */
class RoomUsersCriteria implements CriteriaInterface
{
    /**
     * @var User
     */
    private $userOne;

    /**
     * @var User
     */
    private $userTwo;

    public function __construct(User $userOne, User $userTwo)
    {
        $this->userOne = $userOne;
        $this->userTwo = $userTwo;
    }

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->whereJsonContains('users', [$this->userOne->username, $this->userTwo->username]);
    }
}
