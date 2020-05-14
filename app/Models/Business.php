<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Business.
 *
 * @package namespace App\Models;
 */
class Business extends Model implements Transformable
{
    use TransformableTrait, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'subdomain_prefix',
        'stripe_connect_id',
        'owner_id',
        'unique_id',
        'image',
        'cover',
        'short_description',
        'long_description',
        'primary_color',
        'secondary_color'
    ];

    /**
     * A business can have many users
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'business_user')->withPivot('role_id');
    }

    /**
     * A business can have many jobs.
     *
     * @return HasMany
     */
    public function marketplaceJobs()
    {
        return $this->hasMany(MarketplaceJob::class);
    }

    /**
     * A business can have many applications to join.
     *
     * @return HasMany
     */
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    /**
     * A business has a location.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function location()
    {
        return $this->hasOne(BusinessLocation::class);
    }

    /**
     * The channels the organization receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return 'organization.'.$this->unique_id;
    }
}
