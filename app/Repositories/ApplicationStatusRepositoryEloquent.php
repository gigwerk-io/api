<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\ApplicationStatusRepository;
use App\Models\ApplicationStatus;
use App\Validators\ApplicationStatusValidator;

/**
 * Class ApplicationStatusRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ApplicationStatusRepositoryEloquent extends BaseRepository implements ApplicationStatusRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ApplicationStatus::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
