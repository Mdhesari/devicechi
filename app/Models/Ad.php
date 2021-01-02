<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Database\Factories\AdFactory;
use App\Models\Ad\AdContact;
use Illuminate\Notifications\Notifiable;
use Modules\User\Entities\AdPicture;
use Modules\User\Entities\CityState;
use Modules\User\Entities\PhoneAccessory;
use Modules\User\Entities\PhoneAge;
use Modules\User\Entities\PhoneModel;
use Modules\User\Entities\PhoneVariant;

class Ad extends Model
{
    use HasFactory, Notifiable;

    const STATUS_REJECTED = 0;
    const STATUS_AVAILABLE = 1;
    const STATUS_PENDING = 2;
    const STATUS_UNCOMPLETED = 3;
    const STATUS_UNAVAILABLE = 4;
    const STATUS_ARCHIVE = 5;

    protected $fillable = [
        'title', 'description', 'user_id', 'phone_model_id', 'phone_model_variant_id', 'is_multicard', 'meta_ad', 'state_id', 'price', 'phone_age_id', 'location', 'is_exchangeable', 'meta_data'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_exchangeable' => 'boolean',
        'meta_ad' => 'array'
    ];

    public function isPublished()
    {

        return $this->status !== self::STATUS_UNCOMPLETED;
    }

    public function publish()
    {

        $this->forceFill([
            'status' => self::STATUS_PENDING,
        ])->save();
    }

    public function archive()
    {

        $this->forceFill([
            'status' => self::STATUS_ARCHIVE,
        ])->save();
    }

    public function accept()
    {
        return $this->forceFill([
            'status' => static::STATUS_AVAILABLE,
        ])->save();
    }

    public function ignore($description)
    {
        return $this->forceFill([
            'status' => static::STATUS_REJECTED,
            'meta_ad' => [
                'reject_description' => $description,
            ],
        ])->save();
    }

    public function isAccepted()
    {

        return $this->status === self::STATUS_AVAILABLE;
    }

    public function isIgnored()
    {

        return $this->status === self::STATUS_REJECTED;
    }

    public function resetModel()
    {

        return $this->forceFill([
            'phone_model_id' => null,
            'phone_model_variant_id' => null,
            'is_multicard' => false,
        ])->save();
    }

    public function getHelpAttribute($value)
    {
        $help = "";

        if ($this->isIgnored()) {

            $help = optional($this->meta_ad)['reject_description'];
        }

        return $help ?? "";
    }

    public function loadSingleRelations()
    {

        $this->load(['phoneModel', 'phoneModel.brand', 'pictures', 'variant', 'state.city']);
    }

    public function scopeUncompleted($query)
    {

        return $query->whereStatus(self::STATUS_UNCOMPLETED);
    }

    public function scopeHasPhoneVariant($query)
    {

        return $query->whereNotNull('phone_model_variant_id');
    }

    public function scopeFilterAd($query, $request)
    {

        if (!is_null($status = $request->query('status'))) $query = $query->whereStatus($status);

        if ($search = $request->query('brand_id')) $query = $query->wherePhoneBrandId($search);

        return $query;
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

    public function state()
    {

        return $this->belongsTo(CityState::class);
    }

    public function user()
    {

        return $this->belongsTo(MainUser::class);
    }

    public function age()
    {

        return $this->belongsTo(PhoneAge::class,'phone_age_id');
    }

    public function getAgeInfo()
    {

        $text = "";

        $age = $this->age;

        if (is_null($age)) return $text;

        if ($age->from == "-") {
            $text = trans("user::ads.form.label.age.min", [
                'month' => $age->from
            ]);
        } else if ($age->to == "+") {
            $text = trans("user::ads.form.label.age.max", [
                'month' => $age->to
            ]);
        } else {
            $text = trans("user::ads.form.label.age.between", [
                'min' => $age->from,
                'max' => $age->to
            ]);
        }

        return $text;
    }

    public function getStatus()
    {

        switch ($this->status) {
            case 0:
                $status = __(" REJECTED ");
                break;
            case 1:
                $status = __(" AVAILABLE ");
                break;
            case 2:
                $status = __(" PENDING ");
                break;
            case 3:
                $status = __(" UNCOMPLETED ");
                break;
            case 4:
                $status = __(" UNAVAILABLE ");
                break;
            case 5:
                $status = __(" ARCHIVE ");
            default:
                $status = __(" Invalid ");
        }

        return $status;
    }

    public function getIsMulticardAttribute($value)
    {

        return $value ? __(" Yes ") : __(" No ");
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return AdFactory::new();
    }
}
