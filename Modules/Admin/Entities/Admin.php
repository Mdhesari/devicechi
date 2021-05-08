<?php

namespace Modules\Admin\Entities;

use App\Models\MainUser;
use App\Models\Page;
use App\Models\Payment\Payment;
use App\Models\Post;
use App\Models\TicketMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admin\Database\Factories\AdminFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method static create(array $array) Admin
 * @property string roles_as_string
 */
class Admin extends MainUser
{
    use HasRoles,
        SoftDeletes,
        LogsActivity;

    /**
     * @var string
     */
    protected $table = 'admins';
    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'email_verified_at'];

    /**
     * Payments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {

        return $this->hasMany(Payment::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    /**
     * Get printable roles
     *
     * @return void
     */
    public function getRolesAsStringAttribute()
    {

        $roles = join(', ', $this->roles->pluck('name')->toArray());

        return empty($roles) ? __(' No Roles ') : $roles;
    }

    /**
     * Tickets
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany(TicketMessage::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * guardName
     *
     * @return void
     */
    public function guardName()
    {

        return 'web';
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return AdminFactory::new();
    }
}
