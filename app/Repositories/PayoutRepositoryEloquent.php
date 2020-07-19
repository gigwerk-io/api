<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\PayoutRepository;
use App\Models\Payout;
use App\Validators\PayoutValidator;

/**
 * Class PayoutRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PayoutRepositoryEloquent extends BaseRepository implements PayoutRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Payout::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
