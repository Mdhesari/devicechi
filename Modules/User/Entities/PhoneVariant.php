<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class PhoneVariant extends Model
{
    protected $fillable = ['phone_model_id', 'ram', 'storage'];
}