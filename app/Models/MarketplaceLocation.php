<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class MarketplaceLocation.
 *
 * @package namespace App\Models;
 */
class MarketplaceLocation extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'marketplace_id',
        'street_address',
        'city',
        'state',
        'zip',
        'lat',
        'long'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * A location belongs to a job.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marketplaceJob()
    {
        return $this->belongsTo(MarketplaceJob::class, 'marketplace_id', 'marketplace_id');
    }

    /**
     * Put coords into array format
     *
     * @return array
     */
    public function getCoordinateAttribute()
    {
        return [
            'lat' => $this->lat,
            'long' => $this->long
        ];
    }
}
