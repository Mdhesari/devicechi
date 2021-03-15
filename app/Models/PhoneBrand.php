<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\PhoneModel;

class PhoneBrand extends Model
{

    const ASSET_NAME = 'brands';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'name', 'picture_path', 'persian_name'
    ];

    protected $appends = [
        'printable_name',
        'picture_url',
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function getPictureUrlAttribute()
    {
        return url($this->picture_path);
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

    /**
     * Get printable name
     *
     * @return string
     */
    public function getPrintableNameAttribute()
    {
        return trim($this->name . ' ' . $this->persian_name);
    }

    public function models()
    {

        return $this->hasMany(PhoneModel::class);
    }
}
