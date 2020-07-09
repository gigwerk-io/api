<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class PasswordReset extends Model
{
    protected $fillable = [
        'email', 'token', 'expires_at', 'user_id'
    ];
 
    /**
     * User can one password reset.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
