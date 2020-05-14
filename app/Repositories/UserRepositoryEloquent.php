<?php

namespace App\Repositories;

use App\User\Criteria\EmailOrUsernameCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\UserRepository;
use App\Models\User;
use App\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Find a user by email/username for login.
     *
     * @param string $text
     * @return User|mixed|null
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function findByUsernameOrEmail(string $text)
    {
        $this->pushCriteria(new EmailOrUsernameCriteria($text));
        return $this->first();
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
