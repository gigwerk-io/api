<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\PasswordResetRepository;
use App\Models\PasswordReset;
use App\Validators\PasswordResetValidator;

/**
 * Class PasswordResetRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PasswordResetRepositoryEloquent extends BaseRepository implements PasswordResetRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PasswordReset::class;
    }

    public function findByToken($token)
    {
        return $this->findByField('token', $token);
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
