<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\ChatMessageRepository;
use App\Models\ChatMessage;
use App\Validators\ChatMessageValidator;

/**
 * Class ChatMessageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ChatMessageRepositoryEloquent extends BaseRepository implements ChatMessageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ChatMessage::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
