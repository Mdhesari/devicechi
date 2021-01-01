<?php

namespace Modules\Admin\Entities;

use App\Models\MainUser;
use App\Models\Payment\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method static create(array $array) Admin
 * @property string roles_as_string
 */
class Admin extends MainUser
{
    use HasRoles, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'admins';
    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'email_verified_at'];

    public function payments()
    {

        return $this->hasMany(Payment::class);
    }

    public function getRolesAsStringAttribute()
    {

        $roles = join(', ', $this->roles->pluck('name')->toArray());

        return empty($roles) ? __(' No Roles ') : $roles;
    }

    public function guardName() {

        return 'web';
    }
}
