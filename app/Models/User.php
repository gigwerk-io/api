<?php

namespace App\Models;

use App\Enum\User\Role;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'phone',
        'password',
        'email_verified_at',
        'business_id',
        'last_seen_at',
        'apn_token',
        'fcm_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_seen_at' => 'datetime'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['isActive'];

    /**
     * A user can belong to many businesses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function businesses()
    {
        return $this->belongsToMany(Business::class, 'business_user', 'user_id', 'business_id')->withPivot('role_id');
    }

    /**
     * A user can have many applications to join a business marketplace.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    /**
     * A user can have many jobs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function marketplaceJobs()
    {
        return $this->hasMany(MarketplaceJob::class,'customer_id');
    }

    /**
     * A user has one profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * A user can have many proposals.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function marketplaceProposals()
    {
        return $this->hasMany(MarketplaceProposal::class);
    }

    /**
     * A user can have many saved locations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function savedLocations()
    {
        return $this->hasMany(UserSavedLocation::class);
    }

    /**
     * Last known location of user (geo coordinates)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lastLocation()
    {
        return $this->hasOne(UserLastLocation::class);
    }

    /**
     * A user can have many payment methods.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    /**
     * A user can have one payout method.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function payoutMethod()
    {
        return $this->hasOne(PayoutMethod::class);
    }

    /**
     * A user can have multiple payouts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payouts()
    {
        return $this->hasMany(Payout::class);
    }

    /**
     * A user can have multiple payouts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Return the full name of a user
     *
     * @return string
     */
    public function getNameAttribute(){
        return $this->first_name . " " . $this->last_name;
    }

    /**
     * Get a user's primary payment method.
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasMany|PaymentMethod|null
     */
    public function getPrimaryPaymentMethodAttribute()
    {
        return $this->paymentMethods()->where('default', '=', true)->first();
    }

    /**
     * A user can have a role.
     *
     * @return mixed
     */
    public function getRoleAttribute(){
        return $this->userRole()->name;
    }

    /**
     * Get a user role
     *
     * @param $businessId
     * @return mixed
     */
    public function getRole($businessId)
    {
        return $this->businesses()->where('business_id', '=', $businessId)->first();
    }

    /**
     * Check if the user is a verified freelancer in a specific business.
     *
     * @param $businessId
     * @return bool
     */
    public function isVerifiedFreelancer($businessId)
    {
        return $this->businesses()->where('business_id', '=', $businessId)->first()->pivot->role_id === Role::VERIFIED_FREELANCER;
    }

    /**
     * Check if the user is a customer in a specific business.
     *
     * @param $businessId
     * @return bool
     */
    public function isCustomer($businessId)
    {
        return $this->businesses()->where('business_id', '=', $businessId)->first()->pivot->role_id === Role::CUSTOMER;
    }

    /**
     * Check if user has been active in past month.
     *
     * @return bool
     */
    public function getIsActiveAttribute()
    {
        if(is_null($this->last_seen_at)){
            return false;
        }
        return Carbon::parse(Carbon::now()->subMonth())->lessThan($this->last_seen_at);
    }

    /**
     * The channels the organization receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return 'user.'.$this->id;
    }

    /**
     * Route notifications for the FCM channel.
     *
     * @return string
     */
    public function routeNotificationForFcm()
    {
         return $this->fcm_token;
    }

    /**
     * Route notifications for the APN channel.
     *
     * @return string
     */
    public function routeNotificationForApn()
    {
         return $this->apn_token;
    }
}
