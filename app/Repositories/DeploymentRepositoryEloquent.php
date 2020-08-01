<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\DeploymentRepository;
use App\Models\Deployment;
use App\Validators\DeploymentValidator;

/**
 * Class DeploymentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class DeploymentRepositoryEloquent extends BaseRepository implements DeploymentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Deployment::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
