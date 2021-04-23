<?php

namespace Modules\User\Entities;

use App\Models\Ad;
use App\Space\Contracts\HasOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model implements HasOption
{
    use HasFactory;

    const USER_SESSION_TO_EXPLORE = 'city_to_explore';

    public $timestamps = false;

    protected $fillable = [];

    public function states()
    {
        return $this->hasMany(CityState::class);
    }

    public function ads()
    {
        return $this->hasManyThrough(Ad::class, CityState::class, 'city_id', 'state_id');
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
