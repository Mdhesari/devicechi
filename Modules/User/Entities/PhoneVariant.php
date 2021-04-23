<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class PhoneVariant extends Model
{
    protected $fillable = ['phone_model_id', 'ram', 'storage'];

    protected $appends = ['printableName'];

    public function getPrintableNameAttribute()
    {
        return $this->ram . ' / ' . $this->storage;
    }
}
