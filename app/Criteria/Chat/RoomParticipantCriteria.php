<?php

namespace App\Criteria\Chat;

use App\Models\User;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class RoomParticipantCriteria.
 *
 * @package namespace App\Criteria\Chat;
 */
class RoomParticipantCriteria implements CriteriaInterface
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->whereJsonContains('users', [$this->user->username]);
    }
}
