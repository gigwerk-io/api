<?php

namespace App\Contracts\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PasswordResetRepository.
 *
 * @package namespace App\Contracts\Repositories;
 */
interface PasswordResetRepository extends RepositoryInterface
{
    public function findByToken($token);
}
