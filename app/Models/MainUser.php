<?php

namespace App\Models;

use App\Casts\CustomDateCast;
use App\Models\Payment\Payment;
use App\Space\Contracts\HasOption;
use Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\User\Database\Factories\UserFactory;
use Modules\User\Entities\City;
use Spatie\Permission\Traits\HasRoles;
use Storage;

class MainUser extends User implements HasOption
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = "users";


    protected $casts = [

        'email_verified_at' => CustomDateCast::class,

        'mobile_verified_at' => CustomDateCast::class,

        // 'created_at' => CustomDateCast::class,

        // 'updated_at' => CustomDateCast::class,
    ];

    /**
     * Get option value
     *
     * @return string
     */
    public function getOptionValue(): string
    {
        return $this->id;
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
     * Get option text
     *
     * @return string
     */
    public function getOptionText(): string
    {
        return $this->name . " | " . $this->mobile;
    }

    /**
     * @param $value
     * @return string
     */
    public function getImageAttribute($value)
    {

        return is_null($value) ? asset('images/user.png') : Storage::url($value);
    }

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function getMobileVerificationStatus()
    {

        return $this->mobile_verified_at ? __(' Active ') : __(' Pending ');
    }
    //-----------------Relations------------------//

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function discounts()
    {
        return $this->belongsToMany(Discount::class);
    }

    public function getInfoAttribute($value)
    {

        return $this->name . ' | ' . $this->mobile;
    }

    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }

    public function city()
    {

        return $this->belongsTo(City::class);
    }

    /**
     * routeNotificationForMail
     *
     * @return string|null
     */
    public function routeNotificationForSms()
    {

        return $this->phone;
    }

    /**
     * routeNotificationForMail
     *
     * @return string|null
     */
    public function routeNotificationForMail()
    {

        return $this->email;
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
