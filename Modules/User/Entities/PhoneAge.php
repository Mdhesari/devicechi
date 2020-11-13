<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhoneAge extends Model
{

    protected $fillable = ['from', 'to', 'type'];
}
