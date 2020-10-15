<?php

namespace App\Models\Pivots;

use App\Models\Business;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BusinessUser extends Pivot
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = ['business_id', 'approved_at', 'user_id', 'role_id', 'apn_token', 'fcm_token', 'email_notifications', 'sms_notifications', 'push_notifications'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_notifications' => 'bool',
        'sms_notifications'=> 'bool',
        'push_notifications'=> 'bool'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_user';

    /**
     * The user of the businesss
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A user can have a role in a business
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(UserRole::class);
    }

    /**
     * A user can belongs to a business
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
