<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\UserSavedLocationRepository;
use App\Models\UserSavedLocation;
use App\Validators\UserSavedLocationValidator;

/**
 * Class UserSavedLocationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserSavedLocationRepositoryEloquent extends BaseRepository implements UserSavedLocationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserSavedLocation::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
