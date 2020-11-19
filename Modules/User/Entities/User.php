<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Modules\User\Entities\Ad\AdContactType;
use Modules\User\Notifications\CodeVerificatiNotification;
use Modules\User\Space\Contracts\MustVerifyPhone;
use User\Database\Factories\UserFactory;

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

        return $this->notify(new CodeVerificatiNotification($this, $code));
    }

    public function verifyPhoneNumberIfNotVerified()
    {

        if (!$this->hasVerifiedPhone()) {

            $this->forceFill([
                'phone_verified_at' => $this->freshTimestamp(),
            ])->save();
        }
    }

    /**
     * Get user ads
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ads()
    {

        return $this->hasMany(Ad::class);
    }

    /**
     * Get user contacts
     *
     * @return array
     */
    public function getContacts(): array
    {

        $contacts = [];

        if ($this->phone)
            $contacts[] = [
                'name' => AdContactType::TYPE_PHONE,
                'value' => $this->phone,
                'data' => [
                    'phone_country_code' => $this->phone_country_code
                ],
            ];

        if ($this->email)
            $contacts[] = [
                'name' => AdContactType::TYPE_EMAIL,
                'value' => $this->phone,
            ];

        return $contacts;
    }

    public function hasUncompleteAd()
    {

        return $this->ads()->uncompleted()->count() > 0;
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return new UserFactory;
    }
}
