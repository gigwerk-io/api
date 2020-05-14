<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\MarketplaceLocationRepository;
use App\Models\MarketplaceLocation;
use App\Validators\MarketplaceLocationValidator;

/**
 * Class MarketplaceLocationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MarketplaceLocationRepositoryEloquent extends BaseRepository implements MarketplaceLocationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MarketplaceLocation::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
