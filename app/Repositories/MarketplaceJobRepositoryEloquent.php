<?php

namespace App\Repositories;

use App\Enum\Marketplace\Status;
use App\Models\Payout;
use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\MarketplaceJobRepository;
use App\Models\MarketplaceJob;

/**
 * Class MarketplaceJobRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MarketplaceJobRepositoryEloquent extends BaseRepository implements MarketplaceJobRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MarketplaceJob::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Show requested jobs for marketplace.
     *
     * @param $businessId
     * @return Collection
     */
    public function getRequestedJobs($businessId)
    {
        return $this->with(['customer.profile', 'location'])->findWhere(['status_id' => Status::REQUESTED, 'business_id' => $businessId]);
    }

}
