<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BusinessIntegration.
 *
 * @package namespace App\Models;
 */
class BusinessIntegration extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id',
        'facebook_pixel_id',
        'google_analytics_id',
        'cloudfront_id',
        's3_bucket_id',
        'google_access_token',
        'google_refresh_token',
        'google_expiration'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['calendar_enabled'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['google_access_token', 'google_refresh_token'];

    /**
     * Integrations belong to a business
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    /**
     * Determine if a business's calendar is connected.
     *
     * @return bool
     */
    public function getCalendarEnabledAttribute()
    {
        if (!is_null($this->google_access_token)) {
            return true;
        }

        return false;
    }
}
