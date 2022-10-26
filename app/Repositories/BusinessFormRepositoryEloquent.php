<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\BusinessFormRepository;
use App\Models\BusinessForm;
use App\Validators\BusinessFormValidator;

/**
 * Class BusinessFormRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BusinessFormRepositoryEloquent extends BaseRepository implements BusinessFormRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BusinessForm::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
