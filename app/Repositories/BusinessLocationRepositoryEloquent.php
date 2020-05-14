<?php

namespace App\Repositories;

use App\Contracts\Repositories\BusinessLocationRepository;
use App\Models\BusinessLocation;
use App\Validators\BusinessLocationValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class BusinessLocationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BusinessLocationRepositoryEloquent extends BaseRepository implements BusinessLocationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BusinessLocation::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
