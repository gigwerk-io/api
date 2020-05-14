<?php

namespace App\User\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class EmailOrUsernameCriteria.
 *
 * @package namespace App\Criteria;
 */
class EmailOrUsernameCriteria implements CriteriaInterface
{
    /**
     * @var string
     */
    protected $query;

    public function __construct(string $query)
    {
        $this->query = $query;
    }

    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('username', $this->query)
            ->orWhere('email', $this->query);

        return $model;
    }
}
