<?php

namespace Modules\User\Entities;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
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
}
