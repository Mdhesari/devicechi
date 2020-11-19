<?php

namespace Modules\User\Entities\Ad;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdContactType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];
}
