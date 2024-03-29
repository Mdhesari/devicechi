<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Database\Factories\AdFactory;
use App\Models\Ad\AdContact;
use App\Models\Ad\AdContactType;
use App\Models\Payment\Payment;
use App\Traits\Uuids;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Log;
use Modules\User\Entities\K;
use Modules\User\Entities\CityState;
use Modules\User\Entities\PhoneAccessory;
use Modules\User\Entities\PhoneAge;
use Modules\User\Entities\PhoneModel;
use Modules\User\Entities\PhoneVariant;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Str;

class Ad extends Model implements HasMedia
{
    use HasFactory,
        Notifiable,
        Sluggable,
        InteractsWithMedia,
        SoftDeletes;

    const STATUS_REJECTED = 0;
    const STATUS_AVAILABLE = 1;
    const STATUS_PENDING = 2;
    const STATUS_UNCOMPLETED = 3;
    const STATUS_UNAVAILABLE = 4;
    const STATUS_ARCHIVE = 5;

    const HELP_ALERT_SESSION = 'show_help_ad';

    const STATUS_REJECTED_LABEL = "REJECTED";
    const STATUS_AVAILABLE_LABEL = "AVAILABLE";
    const STATUS_PENDING_LABEL = "PENDING";
    const STATUS_UNCOMPLETED_LABEL = "UNCOMPLETED";
    const STATUS_UNAVAILABLE_LABEL = "UNAVAILABLE";
    const STATUS_ARCHIVE_LABEL = "ARCHIVE";

    protected $fillable = [
        'title', 'slug', 'description', 'user_id', 'phone_model_id', 'phone_model_variant_id', 'is_multicard', 'meta_ad', 'state_id', 'price', 'phone_age_id', 'location', 'is_exchangeable', 'meta_data'
    ];

    protected $appends = [
        'is_multicard_read',
        'is_exchangeable_read',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_exchangeable' => 'boolean',
        'meta_ad' => 'array',
        'status' => 'int',
    ];

    public function getPrintableDescAttribute()
    {

        return preg_replace("/(?:\r\n|\r|\n)/", "<br>", $this->description);
    }

    /**
     * routeNotificationForSms
     *
     * @return string|null
     */
    public function routeNotificationForSms()
    {
        return $this->user->phone;
        // $contact = $this->contacts()->verified()->mobileOnly()->first();

        // if (!$contact) return null;

        // return $contact->value;
    }

    /**
     * routeNotificationForMail
     *
     * @return string|null
     */
    public function routeNotificationForMail()
    {

        $contact = $this->contacts()->whereContactTypeId(AdContactType::TYPE_EMAIL)->first();

        if (!$contact) return null;

        return $contact->value;
    }

    public function getPrintablePromotionsAttribute()
    {
        return join(', ', $this->promotions()->pluck('title')->toArray());
    }

    public function latestPayment()
    {
        return $this->payments()->latest()->first();
    }

    public function getIsMulticardReadAttribute()
    {
        return boolval($this->is_multicard) ? __(' Yes ') : __(' No ');
    }

    public function getShortUrlAttribute()
    {

        return $this->generateShortLink();
    }

    public function getIsExchangeableReadAttribute()
    {

        return $this->is_exchangeable ? __(' Yes ') : __(' No ');
    }

    public function isPublished()
    {

        return $this->status === self::STATUS_AVAILABLE;
    }

    public function getIsPublishedAttribute()
    {

        return $this->isPublished();
    }

    public function isConfirmed()
    {

        return $this->status === self::STATUS_PENDING;
    }

    public function isUncompleted()
    {

        return $this->status === self::STATUS_UNCOMPLETED;
    }

    public function getIsConfirmedAttribute()
    {

        return $this->isConfirmed();
    }

    // ======== Scopes ==================
    public function scopeIncludeMediaThumb($query)
    {

        return $query->with([
            'media' => function ($q) {

                $q->activeOnly();
            }
        ]);
    }

    public function scopePublished($query)
    {

        return $query->whereStatus(static::STATUS_AVAILABLE);
    }

    public function scopeFilterPro($query)
    {

        return $query->where('is_pro', true);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function updateCaption($caption)
    {

        return $this->forceFill([
            'caption' => $caption,
        ])->save();
    }

    public function proSign()
    {

        return $this->forceFill([
            'is_pro' => true,
        ])->save();
    }

    public function publish()
    {

        return $this->forceFill([
            'status' => self::STATUS_PENDING,
        ])->save();
    }

    public function archive()
    {

        return $this->forceFill([
            'status' => self::STATUS_ARCHIVE,
        ])->save();
    }

    public function uncomplete()
    {

        return $this->forceFill([
            'status' => self::STATUS_UNCOMPLETED,
        ])->save();
    }

    public function accept($admin_id)
    {
        return $this->forceFill([
            'status' => static::STATUS_AVAILABLE,
            'meta_ad' => [
                'admin_id' => $admin_id
            ]
        ])->save();
    }

    public function ignore($description, $admin_id)
    {
        return $this->forceFill([
            'status' => static::STATUS_REJECTED,
            'meta_ad' => [
                'reject_description' => $description,
                'admin_id' => $admin_id
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

        $this->load(['accessories', 'phoneModel', 'phoneModel.brand', 'variant', 'state.city', 'media']);

        return $this;
    }

    public function scopeUncompleted($query)
    {

        return $query->whereStatus(self::STATUS_UNCOMPLETED);
    }

    public function scopeHasPhoneVariant($query)
    {

        return $query->whereNotNull('phone_model_variant_id');
    }

    public function scopeFilterCity($query, $name)
    {
        return $query->searchLike('state.city.name', $name);
    }

    public function scopePublishedWithFilter($query, $request)
    {

        $query->published()->where(function ($query) use ($request) {

            $query->filterAd($request);
        });

        return $query;
    }

    public function scopeFilterAd($query, $request)
    {

        $status = $request->input('status', null);

        $query->when(
            !is_null($status),
            function ($query) use ($status) {
                if (is_string($status)) {
                    $status = Str::upper($status);
                    $status = static::getStatusNumber($status);
                }

                $query = $query->whereStatus($status);
            }
        );

        if ($search = $request->input('brand_id')) {

            $query = $query->wherePhoneBrandId($search);
        }

        if ($search = $request->input('q')) {

            $query = $query->searchLike([
                'title',
                'description',
                'state.name',
                'state.city.name',
                'phoneModel.name',
                'phoneModel.brand.name',
                'phoneModel.brand.persian_name'
            ], $search);
        }

        return $query;
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class);
    }

    public function isPromotionPaid($promotion)
    {
        return $this->promotions->contains($promotion);
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

    public function getPicturesAttribute()
    {

        return $this->getMedia();
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

        return $this->belongsTo(PhoneAge::class, 'phone_age_id');
    }

    public function getAgeInfo()
    {
        $text = "";

        $age = $this->age;

        if (is_null($age)) return $text;

        if ($age->from == "-") {
            $text = trans("user::ads.form.label.age.min", [
                'month' => $age->to
            ]);
        } else if ($age->to == "+") {
            $text = trans("user::ads.form.label.age.max", [
                'month' => $age->from
            ]);
        } else {
            $text = trans("user::ads.form.label.age.between", [
                'min' => $age->from,
                'max' => $age->to
            ]);
        }

        return $text;
    }

    public function getFormattedPrice()
    {
        return number_format($this->price) . ' تومان ';
    }

    public static function getStatusNumber($status = null)
    {

        switch ($status) {
            case static::STATUS_REJECTED_LABEL:
                $status = static::STATUS_REJECTED;
                break;
            case static::STATUS_AVAILABLE_LABEL:
                $status = static::STATUS_AVAILABLE;
                break;
            case static::STATUS_PENDING_LABEL:
                $status = static::STATUS_PENDING;
                break;
            case static::STATUS_UNCOMPLETED_LABEL:
                $status = static::STATUS_UNCOMPLETED;
                break;
            case static::STATUS_UNAVAILABLE_LABEL:
                $status = static::STATUS_UNAVAILABLE;
                break;
            case static::STATUS_ARCHIVE_LABEL:
                $status = static::STATUS_ARCHIVE;
                break;
            default:
                $status = __(" Invalid ");
        }

        return $status;
    }

    public function getStatus($status = null)
    {
        if (is_null($status))
            $status = $this->status;

        switch ($status) {
            case static::STATUS_REJECTED:
                $label = static::STATUS_REJECTED_LABEL;
                $status = __(" {$label} ");
                break;
            case static::STATUS_AVAILABLE:
                $label = static::STATUS_AVAILABLE_LABEL;
                $status = __(" {$label} ");
                break;
            case static::STATUS_PENDING:
                $label = static::STATUS_PENDING_LABEL;
                $status = __(" {$label} ");
                break;
            case static::STATUS_UNCOMPLETED:
                $label = static::STATUS_UNCOMPLETED_LABEL;
                $status = __(" {$label} ");
                break;
            case static::STATUS_UNAVAILABLE:
                $label = static::STATUS_UNAVAILABLE_LABEL;
                $status = __(" {$label} ");
                break;
            case static::STATUS_ARCHIVE:
                $label = static::STATUS_ARCHIVE_LABEL;
                $status = __(" {$label} ");
                break;
            default:
                $status = __(" Invalid ");
        }

        return $status;
    }

    public function getMulticardInfoAttribute($value)
    {

        return $value ? __(" Yes ") : __(" No ");
    }

    public function shortLink()
    {

        return $this->morphOne(ShortLink::class, 'shorttable');
    }

    public function generateShortLink()
    {

        if (is_null($this->title)) return;

        $shortLink = $this->shortLink()->firstOrCreate([
            'link' => route('user.ad.show', [
                'ad' => $this->slug
            ]),
        ]);

        $code = $shortLink->getAttributes()['code'];

        return route('shortlink', [
            'code' => $code
        ]);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title', 'state.name', 'state.city.name'],
            ],
        ];
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(600)
            ->height(600)
            ->nonQueued();
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'resource');
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
