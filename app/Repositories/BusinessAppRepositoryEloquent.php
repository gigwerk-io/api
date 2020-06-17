<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\BusinessAppRepository;
use App\Models\BusinessApp;
use App\Validators\BusinessAppValidator;

/**
 * Class BusinessAppRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BusinessAppRepositoryEloquent extends BaseRepository implements BusinessAppRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BusinessApp::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
