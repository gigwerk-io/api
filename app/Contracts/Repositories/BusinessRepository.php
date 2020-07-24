<?php

namespace App\Contracts\Repositories;

use App\Models\Business;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BusinessRepository.
 *
 * @package namespace App\Contracts\Repositories;
 */
interface BusinessRepository extends RepositoryInterface
{
    /**
     * Find a business by it's unique id
     *
     * @param string $uuid
     * @return Business
     */
    public function findByUuid(string $uuid);
}
