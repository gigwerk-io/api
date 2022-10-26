<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\ApplicationEventRepository;
use App\Models\ApplicationEvent;
use App\Validators\ApplicationEventValidator;

/**
 * Class ApplicationEventRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ApplicationEventRepositoryEloquent extends BaseRepository implements ApplicationEventRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ApplicationEvent::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
