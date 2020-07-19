<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\BusinessUserRepository;
use App\Validators\BusinessUserRepositoryValidator;

/**
 * Class BusinessUserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BusinessUserRepositoryEloquent extends BaseRepository implements BusinessUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BusinessUserRepository::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
