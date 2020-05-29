<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ChatMessage.
 *
 * @package namespace App\Models;
 */
class ChatMessage extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['sender_id', 'chat_room_id', 'text', 'read'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['read' => 'bool'];

    /**
     * A message belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room()
    {
        return $this->belongsTo(ChatRoom::class, 'chat_room_id');
    }

    /**
     * The sender of the message
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(User::class);
    }
}
