<?php

namespace Modules\Admin\Entities;

use App\Models\MainUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends MainUser
{
    use SoftDeletes;

    /**
     * guard_name
     *
     * @var string
     */
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'phone_country_code', 'city_id'
    ];

    // protected static function newFactory()
    // {
    //     return \Modules\Admin\Database\factories\UserFactory::new();
    // }
}
