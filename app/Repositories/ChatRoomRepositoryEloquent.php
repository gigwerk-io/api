<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\ChatRoomRepository;
use App\Models\ChatRoom;
use App\Validators\ChatRoomValidator;

/**
 * Class ChatRoomRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ChatRoomRepositoryEloquent extends BaseRepository implements ChatRoomRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ChatRoom::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
