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
    protected $fillable = ['sender_id', 'room_id', 'text', 'read'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['read' => 'bool'];
}
