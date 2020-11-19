<?php

namespace Modules\User\Entities\Ad;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\Ad;

class AdContact extends Model
{
    use HasFactory;

    protected $fillable = ['value', 'data'];

    protected $casts = [
        'data' => 'array',
    ];

    public function ad()
    {

        return $this->belongsTo(Ad::class);
    }

    public function type()
    {

        return $this->belongsTo(AdContactType::class);
    }

    public function getValueAttribute($value)
    {

        if ($code = $this->data->phone_country_code) {

            $value = "+$code $value";
        }

        return $value;
    }
}
