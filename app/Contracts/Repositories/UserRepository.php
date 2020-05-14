<?php

namespace App\Contracts\Repositories;

use App\Models\User;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Contracts\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    /**
     * @param string $text
     * @return User|null
     */
    public function findByUsernameOrEmail(string $text);
}
