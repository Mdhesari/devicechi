<?php

namespace Modules\User\Entities;

use App\Models\PhoneBrand;
use App\Space\Contracts\HasOption;
use Illuminate\Database\Eloquent\Model;

class PhoneModel extends Model implements HasOption
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

    public function brand()
    {

        return $this->belongsTo(PhoneBrand::class, 'phone_brand_id');
    }

    public function scopeExcludeModel($query, $ad)
    {
        if (is_null($ad) || !isset($ad->phoneModel)) return $query;

        return $query->where('id', '!=', $ad->phoneModel->id);
    }

    public static function scopeFilterSearch($query, $search)
    {

        return $query->where('Name', 'Like',  "%$search%");
    }

    public function getOptionText(): string
    {
        return $this->name;
    }

    public function getOptionValue(): string
    {
        return $this->id;
    }
}
