<?php

namespace Modules\Team\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User as MainUser;
use Spatie\Permission\Traits\HasRoles;

class User extends MainUser
{
    use HasFactory, HasRoles;

    protected $fillable = [];
}
