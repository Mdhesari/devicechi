<?php

namespace App\Models\Ad;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\Ad;
use ftp;
use Modules\User\Database\Factories\AdContactFactory;
use Modules\User\Notifications\CodeVerificatiNotification;

class AdContact extends Model
{
    use HasFactory,
        Notifiable;

    const VERIFICATION_SESSION = 'ad_contact_verification_code';

    protected $fillable = ['ad_id', 'contact_type_id', 'value', 'data', 'value_verified_at'];

    protected $casts = [
        'data' => 'array',
        'value_verified_at' => 'date',
    ];

    protected $verification_code;

    public function scopeVerified($query)
    {

        return $query->whereNotNull('value_verified_at');
    }

    public function ad()
    {

        return $this->belongsTo(Ad::class);
    }

    public function type()
    {

        return $this->belongsTo(AdContactType::class, 'contact_type_id');
    }

    public function getValueAttribute($value)
    {

        if ($this->data && $code = $this->data['phone_country_code']) {

            $code = trim($code, '+');

            $value = "+{$code}{$value}";
        }

        return $value;
    }

    public function isNotVerified()
    {

        return is_null($this->value_verified_at);
    }

    public function sendVerification($data)
    {
        return $this->notify(new CodeVerificatiNotification($data));
    }

    public function setValueAsVerified()
    {

        return $this->forceFill([
            'value_verified_at' => now(),
        ])->save();
    }

    public function routeNotificationForSms()
    {

        return $this->value;
    }

    public function routeNotificationForMail()
    {

        return $this->value;
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return new AdContactFactory;
    }
}
