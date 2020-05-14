<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\UserProfileRepository;
use App\Models\UserProfile;
use App\Validators\UserProfileValidator;

/**
 * Class UserProfileRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserProfileRepositoryEloquent extends BaseRepository implements UserProfileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserProfile::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
