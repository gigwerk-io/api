<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\BusinessProfileRepository;
use App\Models\BusinessProfile;
use App\Validators\BusinessProfileValidator;

/**
 * Class BusinessProfileRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BusinessProfileRepositoryEloquent extends BaseRepository implements BusinessProfileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BusinessProfile::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
