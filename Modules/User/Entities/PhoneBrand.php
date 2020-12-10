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

    public static function scopeExcludeAd($query, $ad)
    {

        if (is_null($ad) || !isset($ad->phoneModel)) return $query;

        return $query->where('id', '!=', $ad->phoneModel->brand->id);
    }

    public static function scopeFilterSearch($query, $search)
    {

        return $query->where('Name', 'Like',  "%$search%");
    }

    public function models()
    {

        return $this->hasMany(PhoneModel::class);
    }
}
