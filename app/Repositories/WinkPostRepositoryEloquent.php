<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\WinkPostRepository;
use App\Validators\WinkPostValidator;
use Wink\WinkPost;

/**
 * Class WinkPostRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class WinkPostRepositoryEloquent extends BaseRepository implements WinkPostRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return WinkPost::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function findBySlug(string $slug)
    {
        $post = $this->findByField('slug', $slug)->first();
        if (is_null($post)) {
            throw new ModelNotFoundException(sprintf('The post with the slug of %s could not be found.', $slug));
        }

        return $post;
    }


}
