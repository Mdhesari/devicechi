<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class PhoneModel extends Model
{
    protected $fillable = ['name', 'phone_brand_id'];
}
