<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Ad\AdContact;
use Modules\User\Exceptions\PhoneBrandNotFound;
use Str;
use User\Database\Factories\AdFactory;

class Ad extends Model
{
    use HasFactory;

    const STATUS_REJECTED = 0;
    const STATUS_AVAILABLE = 1;
    const STATUS_PENDING = 2;
    const STATUS_UNCOMPLETED = 3;
    const STATUS_UNAVAILABLE = 4;

    protected $fillable = [
        'title', 'description', 'user_id', 'phone_model_id', 'phone_model_variant_id', 'is_multicard', 'meta_ad', 'state_id', 'price', 'phone_age_id', 'location'
    ];

    public function publish()
    {

        $this->forceFill([
            'status' => self::STATUS_PENDING,
        ])->save();
    }

    public function archive()
    {

        $this->forceFill([
            'is_archive' => true,
        ])->save();
    }

    public function scopeUncompleted($query)
    {

        return $query->whereStatus(self::STATUS_UNCOMPLETED);
    }

    public function scopeHasPhoneVariant($query)
    {

        return $query->whereNotNull('phone_model_variant_id');
    }

    public function missingPhoneAccessories()
    {

        return $this->accessories()->count() < 1;
    }

    public function missingPhoneModelVariant()
    {

        return is_null($this->phone_model_variant_id);
    }

    public function missingPhoneAge()
    {

        return is_null($this->phone_age_id);
    }

    public function missingPhoneModel()
    {

        return is_null($this->phone_model_id);
    }

    public function missingDetails()
    {

        return is_null($this->title) || is_null($this->description);
    }

    public function missingState()
    {

        return is_null($this->state_id);
    }

    public function missingPrice()
    {

        return is_null($this->price);
    }

    public function accessories()
    {

        return $this->belongsToMany(PhoneAccessory::class, 'accessories_ad');
    }

    public function phoneModel()
    {

        return $this->belongsTo(PhoneModel::class);
    }

    public function pictures()
    {

        return $this->hasMany(AdPicture::class);
    }

    public function contacts()
    {

        return $this->hasMany(AdContact::class);
    }

    public function variant()
    {

        return $this->belongsTo(PhoneVariant::class, 'phone_model_variant_id');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return new AdFactory();
    }
}
