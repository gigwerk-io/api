<?php

namespace App\Contracts\Repositories;

use App\Models\MarketplaceJob;
use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface MarketplaceJobRepository.
 *
 * @package namespace App\Contracts\Repositories;
 */
interface MarketplaceJobRepository extends RepositoryInterface
{
    /**
     * Show requested jobs for marketplace.
     *
     * @param $businessId
     * @return Collection|MarketplaceJob[]
     */
    public function getRequestedJobs($businessId);
}
