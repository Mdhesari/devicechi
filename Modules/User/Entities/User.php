<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Modules\User\Notifications\CodeVerificatiNotification;
use Modules\User\Space\Contracts\MustVerifyPhone;

class User extends Authenticatable implements MustVerifyPhone
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    // use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'phone_country_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function hasVerifiedPhone()
    {

        return !is_null($this->phone_verified_at);
    }

    public function sendVerificationNotification($code)
    {

        $this->notify(new CodeVerificatiNotification($this, $code));
    }

    public function verifyPhoneNumberIfNotVerified()
    {

        if (!$this->hasVerifiedPhone()) {

            $this->forceFill([
                'phone_verified_at' => $this->freshTimestamp(),
            ])->save();
        }
    }
}
