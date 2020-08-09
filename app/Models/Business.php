<?php

namespace App\Models;

use App\Models\Pivots\BusinessUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Class business.
 *
 * @package namespace App\Models;
 */
class Business extends Model implements Transformable, HasMedia
{
    use TransformableTrait, Notifiable, InteractsWithMedia, Billable;

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
        'is_accepting_applications',
        'facebook_pixel_id',
        'google_analytics_id',
        'cloudfront_id',
        's3_bucket_id',
        'is_approved'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_accepting_applications' => 'bool',
        'is_approved' => 'bool'
    ];

    /**
     * A business can have many users
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'business_user')->using(BusinessUser::class)
            ->withPivot(['role_id', 'apn_token', 'fcm_token', 'email_notifications', 'sms_notifications', 'push_notifications']);
    }

    /**
     * A business can have a lot of deployments
     *
     * @return HasMany
     */
    public function deployments()
    {
        return $this->hasMany(Deployment::class);
    }

    /**
     * A business can have one owner
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner() {
        return $this->belongsTo(User::class);
    }

    /**
     * A business can have a profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(BusinessProfile::class);
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
     * A business can have one app.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function businessApp()
    {
        return $this->hasOne(BusinessApp::class);
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

    /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return array|string
     */
    public function routeNotificationForMail($notification)
    {
        // Return name and email address...
        return [$this->owner->email => $this->name];
    }
}
