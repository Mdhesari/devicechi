<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{

    const STATUS_UNAVAILABLE = 0;
    const STATUS_AVAILABLE = 1;
    const STATUS_PENDING = 2;
    const STATUS_UNCOMPLETED = 3;

    protected $fillable = [
        'title', 'description', 'phone_model_id', 'model_variant_id', 'is_multicard', 'meta_ad', 'city_id', 'price', 'age', 'location'
    ];
}
