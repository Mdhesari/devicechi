<?php

namespace Modules\Team\Tests\Feature\Permission;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Team\Entities\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminTest extends TestCase
{

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('module:seed');
        $this->actingAs($this->user = User::factory()->create());
    }

    public function test_if_can_go_to_protected_route()
    {

        $role = Role::create(['name' => 'editor']);

        $permission = Permission::create(['name' => 'view_blog']);

        $role->givePermissionTo($permission);

        $this->user->assignRole($role);

        $admin = $this->user->roles;

        dd($admin);
    }
}
