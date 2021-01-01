<?php

namespace App\Models\Ad;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\Ad;
use Modules\User\Notifications\CodeVerificatiNotification;
use Modules\User\Notifications\ContactCodeVerificationNotification;
use Modules\User\Space\Contracts\AdContactMustVerifyValue;
use User\Database\Factories\AdFactory;

class AdContact extends Model implements AdContactMustVerifyValue
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

    public function setVerificationCode($code)
    {

        $this->verification_code = $code;
    }

    public function getVerificationCode()
    {
        return $this->verification_code;
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
}
