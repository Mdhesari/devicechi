<?php

namespace Modules\Admin\Tests\Feature\Users;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Admin\Entities\Admin;

class BaseUsersCase extends TestCase
{
    protected $admin;

    protected $repository;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();

        $this->artisan('module:seed Admin');

        $this->admin = Admin::factory()->create();

        $this->actingAs($this->admin);
    }

    /**
     * GiveCreateUserPermission
     *
     * @return void
     */
    public function giveCreateUserPermission()
    {

        $this->admin->givePermissionTo('create user');
    }

    /**
     * GiveCreateUserPermission
     *
     * @return void
     */
    public function giveReadUserPermission()
    {

        $this->admin->givePermissionTo('read user');
    }

    /**
     * giveDeleteUserPermission
     *
     * @return void
     */
    public function giveDeleteUserPermission()
    {

        $this->admin->givePermissionTo('delete user');
    }
}
