<?php

namespace Modules\User\Entities;

use App\Space\Contracts\HasOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CityState extends Model implements HasOption
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [];

    public function city()
    {

        return $this->belongsTo(City::class);
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
