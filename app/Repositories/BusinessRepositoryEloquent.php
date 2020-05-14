<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\BusinessRepository;
use App\Models\Business;
use App\Validators\BusinessValidator;

/**
 * Class BusinessRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BusinessRepositoryEloquent extends BaseRepository implements BusinessRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Business::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
