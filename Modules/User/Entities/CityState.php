<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CityState extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [];
}
