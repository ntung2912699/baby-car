<?php

namespace App\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
 use App\Mail\CustomResetPasswordMail;
 use Illuminate\Support\Facades\Mail;

 class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'roles_id',
        'facebook_id',
        'facebook_token',
        'facebook_refresh_token',
        'google_id',
        'avatar',
        'otp',
        'otp_expiry'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->roles_id !== 1;
    }

     /**
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
      */
     public function roles()
     {
         return $this->belongsTo(UserRoles::class);
     }

     /**
      * @param string $token
      */
     public function sendPasswordResetNotification($token)
     {
         Mail::to($this->email)->send(new CustomResetPasswordMail($token, $this->email, $this->name));
     }
}
