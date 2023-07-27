<?php

namespace Modules\User\Entities;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Modules\User\Database\Factories\UserFactory;
use App\Models\Ad\AdContact;
use App\Models\Ad\AdContactType;
use App\Models\MainUser;
use Modules\User\Notifications\CodeVerificatiNotification;
use Modules\User\Repositories\Contracts\AdContactRepositoryInterface;
use Modules\User\Space\Contracts\MustVerifyPhone;
use Storage;

class User extends MainUser implements MustVerifyPhone
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'phone_country_code', 'city_id', 'meta_user'
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
        'meta_user' => 'array'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getNameAttribute($value)
    {

        return __($value);
    }

    public function hasVerifiedPhone()
    {

        return !is_null($this->phone_verified_at);
    }

    public function sendVerificationNotification($data)
    {

        return $this->notify(new CodeVerificatiNotification($data));
    }

    public function verifyPhoneNumberIfNotVerified()
    {

        if (!$this->hasVerifiedPhone()) {

            $this->forceFill([
                'phone_verified_at' => $this->freshTimestamp(),
            ])->save();
        }
    }

    public function setPhoneUnverified()
    {

        if ($this->hasVerifiedPhone()) {

            $this->forceFill([
                'phone_verified_at' => null,
            ])->save();
        }
    }

    public function setNewPassword($password)
    {

        $this->forceFill([
            'password' => $password,
        ])->save();
    }

    public function bookmarkedAds()
    {

        return $this->belongsToMany(Ad::class);
    }

    public function seenAds()
    {
        return $this->belongsToMany(Ad::class, 'ad_user_seen')->withPivot('count');
    }

    public function readAd($ad)
    {

        if ($this->id === $ad->user->id) return;

        $existing_ad = $this->seenAds()->whereAdId($ad->id)->first();

        if ($existing_ad) {

            return $existing_ad->pivot->update([
                'count' => ++$existing_ad->pivot->count
            ]);
        }

        return $this->seenAds()->attach($ad, [
            'count' => 1
        ]);
    }

    public function hasUncompleteAd()
    {

        return $this->ads()->uncompleted()->count() > 0;
    }

    public function getProfilePhotoPathAttribute($value)
    {
        return is_null($value) ? asset('images/user.png') : Storage::url($value);
    }

    public function getHelpAlertAdAttribute()
    {
        return optional($this->user_meta)[Ad::HELP_ALERT_SESSION] ?: true;
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
