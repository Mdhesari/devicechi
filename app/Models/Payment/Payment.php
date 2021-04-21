<?php

namespace App\Models\Payment;

use App\Models\MainUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Database\Factories\PaymentFactory;
use Modules\Admin\Entities\Admin;

class Payment extends Model
{
    use HasFactory;

    const FAILED = 0;
    const SUCCESS = 1;
    const PENDING = 2;
    const REJECTED = 3;

    protected $fillable = ['amount', 'user_id', 'transaction_id', 'currency', 'meta'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta' => 'array',
    ];

    public function missingPromotions()
    {
        return !isset($this->meta['promotions']);
    }

    //-----------------Relations------------------//
    public function user()
    {
        return $this->belongsTo(MainUser::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function resource()
    {
        return $this->morphTo(__FUNCTION__, 'resource_type', 'resource_id');
    }
    // ---------- End Relations ----------------------

    // ----------------- Attributes ----------------
    public function getPromotionsAttribute()
    {
        return $this->missingPromotions() ? null : $this->meta['promotions'];
    }

    public function getStatusAttribute($value)
    {
        switch ($value) {
            case static::FAILED:
                $value = 'عدم پرداخت';
                break;
            case static::SUCCESS:
                $value = 'پرداخت شده';
                break;
            case static::PENDING:
                $value = 'در حال پرداخت';
                break;
            case static::REJECTED:
                $value = 'رد شده';
                break;
        }

        return $value;
    }

    public function setAsVerified()
    {
        return $this->forceFill([
            'status' => static::SUCCESS,
            'verified_at' => now(),
        ])->save();
    }

    public function getTitleAttribute($value)
    {

        return $value ?? __(' No Title ');
    }

    public function getDescriptionAttribute($value)
    {

        return $value ?? __(' No Description ');
    }

    public function getFormattedAmountAttribute($value)
    {
        //TODO: dynamic currency
        return number_format($this->amount) . ' تومان ';
    }

    // ------------- End Attributes --------------

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return PaymentFactory::new();
    }
}
