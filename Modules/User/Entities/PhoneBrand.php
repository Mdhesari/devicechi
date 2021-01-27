<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class PhoneBrand extends Model
{

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'name', 'picture_path', 'persian_name'
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

        return $query->searchLike(['name', 'persian_name'], $search);
    }

    public function models()
    {

        return $this->hasMany(PhoneModel::class);
    }
}
