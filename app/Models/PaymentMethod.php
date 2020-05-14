<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PaymentMethod.
 *
 * @package namespace App\Models;
 */
class PaymentMethod extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'stripe_customer_id',
        'stripe_card_id',
        'card_type',
        'card_last4',
        'exp_month',
        'exp_year',
        'default'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['default' => 'boolean'];

    /**
     * A user can have many payment methods.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
