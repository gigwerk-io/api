<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\JobStatusRepository;
use App\Models\JobStatus;
use App\Validators\JobStatusValidator;

/**
 * Class JobStatusRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class JobStatusRepositoryEloquent extends BaseRepository implements JobStatusRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return JobStatus::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
