<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\MarketplaceProposalRepository;
use App\Models\MarketplaceProposal;
use App\Validators\MarketplaceProposalValidator;

/**
 * Class MarketplaceProposalRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MarketplaceProposalRepositoryEloquent extends BaseRepository implements MarketplaceProposalRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MarketplaceProposal::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
