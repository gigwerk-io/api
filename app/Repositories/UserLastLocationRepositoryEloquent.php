<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\UserLastLocationRepository;
use App\Models\UserLastLocation;
use App\Validators\UserLastLocationValidator;

/**
 * Class UserLastLocationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserLastLocationRepositoryEloquent extends BaseRepository implements UserLastLocationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserLastLocation::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
