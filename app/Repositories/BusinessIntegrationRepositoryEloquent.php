<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\BusinessIntegrationRepository;
use App\Models\BusinessIntegration;
use App\Validators\BusinessIntegrationValidator;

/**
 * Class BusinessIntegrationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BusinessIntegrationRepositoryEloquent extends BaseRepository implements BusinessIntegrationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BusinessIntegration::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
