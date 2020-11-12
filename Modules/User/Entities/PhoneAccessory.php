<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class PhoneAccessory extends Model
{
    protected $fillable = ['title', 'picture_path'];

    public function ads()
    {

        return $this->belongsToMany(PhoneAccessory::class, 'accessories_ad');
    }
}
