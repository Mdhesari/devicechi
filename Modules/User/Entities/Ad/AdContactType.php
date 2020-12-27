<?php

namespace Modules\User\Entities\Ad;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdContactType extends Model
{
    use HasFactory;

    const TYPE_EMAIL = 'email';
    const TYPE_PHONE = 'phone';

    public $timestamps = false;

    protected $casts = [
        "data" => "array",
    ];

    protected $fillable = ['name', 'description', 'data', 'validation'];

    public function getDescriptionAttribute($description)
    {

        $trans_key = "user::contacts.types.descriptions.$description";
        $trans_value = trans($trans_key);

        return $trans_value == $trans_key ? $description : $trans_value;
    }
}
