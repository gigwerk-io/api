<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\ApplicationFormRepository;
use App\Models\ApplicationForm;
use App\Validators\ApplicationFormValidator;

/**
 * Class ApplicationFormRepositoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ApplicationFormRepositoryEloquent extends BaseRepository implements ApplicationFormRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ApplicationForm::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
