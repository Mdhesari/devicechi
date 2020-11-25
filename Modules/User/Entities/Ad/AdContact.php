<?php

namespace Modules\User\Entities\Ad;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\Ad;

class AdContact extends Model
{
    use HasFactory;

    protected $fillable = ['ad_id', 'contact_type_id', 'value', 'data'];

    protected $casts = [
        'data' => 'array',
    ];

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

            $value = "+$code $value";
        }

        return $value;
    }
}
