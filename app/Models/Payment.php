<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Payment.
 *
 * @package namespace App\Models;
 */
class Payment extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['marketplace_id', 'user_id', 'amount', 'stripe_token', 'refunded'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['refunded' => 'bool'];

    /**
     * A payment belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A payment belongs to a job
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marketplaceJob()
    {
        return $this->belongsTo(MarketplaceJob::class, 'marketplace_id');
    }
}
