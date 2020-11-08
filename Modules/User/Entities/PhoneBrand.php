<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class PhoneBrand extends Model
{
    protected $fillable = [
        'name', 'picture_path',
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function models()
    {

        return $this->hasMany(PhoneModel::class);
    }
}
