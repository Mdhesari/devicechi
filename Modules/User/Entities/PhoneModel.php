<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class PhoneModel extends Model
{
    protected $fillable = ['name', 'phone_brand_id'];

    public function variants()
    {

        return $this->hasMany(PhoneVariant::class);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
