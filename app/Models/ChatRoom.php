<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ChatRoom.
 *
 * @package namespace App\Models;
 */
class ChatRoom extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'users', 'business_id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['users' => 'json'];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['members', 'last_message'];

    /**
     * Chat room has many messages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(ChatMessage::class, 'chat_room_id');
    }

    /**
     * A chat room belongs to a businesses app
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    /**
     * Chat room has many users.
     *
     * @return User[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getMembersAttribute()
    {
        return User::with('profile')->whereIn('username', $this->users)->get();
    }

    /**
     * Last message of a chat room.
     *
     * @return ChatMessage|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     */
    public function getLastMessageAttribute()
    {
        return $this->messages()->with('sender.profile')->orderByDesc('id')->first();
    }
}
