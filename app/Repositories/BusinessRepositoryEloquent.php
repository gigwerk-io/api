<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    /**
     * Find a business by it's unique id
     *
     * @param string $uuid
     * @return Business
     */
    public function findByUuid(string $uuid)
    {
        $business = $this->findByField('unique_id', $uuid)->first();
        if (is_null($business)) {
            throw new ModelNotFoundException(sprintf('The business with the unique_id of %s could not be found.', $uuid));
        }
        return $this->findByField('unique_id', $uuid)->first();
    }


}
