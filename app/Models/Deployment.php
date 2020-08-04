<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Deployment.
 *
 * @package namespace App\Models;
 */
class Deployment extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['build_time', 'status'];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'business_id',
        'deployment_status_id',
        'start_time',
        'end_time'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_time',
        'end_time'
    ];

    /**
     * A deployment belongs to a business
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    /**
     * A deployment has a status
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status()
    {
        return $this->hasOne(DeploymentStatus::class, 'id', 'deployment_status_id');
    }

    /**
     * Get the build time in minutes.
     *
     * @return int|null
     */
    public function getBuildTimeAttribute()
    {
        if (is_null($this->start_time) || is_null($this->end_time)) {
            return null;
        }

        return Carbon::parse($this->start_time)->diffInMinutes($this->end_time);
    }

    /**
     * Get the name of the status
     *
     * @return mixed
     */
    public function getStatusAttribute()
    {
        return $this->status()->first()->name;
    }
}
