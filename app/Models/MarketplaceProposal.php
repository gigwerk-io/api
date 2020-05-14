<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class MarketplaceProposal.
 *
 * @package namespace App\Models;
 */
class MarketplaceProposal extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'marketplace_id',
        'user_id',
        'status_id',
        'rating',
        'review',
        'arrived_at',
        'completed_at'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['status'];

    /**
     * A proposal belongs to a marketplace job.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marketplaceJob()
    {
        return $this->belongsTo(MarketplaceJob::class, 'marketplace_id');
    }

    /**
     * A proposal has one user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A proposal has a status
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function proposalStatus()
    {
        return $this->hasOne(ProposalStatus::class, 'id', 'status_id');
    }

    /**
     * Get the name of the proposal status.
     *
     * @return mixed
     */
    public function getStatusAttribute()
    {
        return $this->proposalStatus->name;
    }
}
