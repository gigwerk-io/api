<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\PayoutMethodRepository;
use App\Models\PayoutMethod;
use App\Validators\PayoutMethodValidator;

/**
 * Class PayoutMethodRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PayoutMethodRepositoryEloquent extends BaseRepository implements PayoutMethodRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PayoutMethod::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
