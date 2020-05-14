<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Application.
 *
 * @package namespace App\Models;
 */
class Application extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status_id', 'user_id'];

    /**
     * An application belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * An application has a status
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function applicationStatus()
    {
        return $this->hasOne(ApplicationStatus::class, 'status_id');
    }
}
