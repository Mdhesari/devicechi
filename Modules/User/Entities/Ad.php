<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'title', 'description', 'model_id', 'model_variant_id', 'is_multicard', 'meta_ad', 'city_id', 'price', 'age', 'location'
    ];
}
