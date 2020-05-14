<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\JobIntensityRepository;
use App\Models\JobIntensity;
use App\Validators\JobIntensityValidator;

/**
 * Class JobIntensityRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class JobIntensityRepositoryEloquent extends BaseRepository implements JobIntensityRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return JobIntensity::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
