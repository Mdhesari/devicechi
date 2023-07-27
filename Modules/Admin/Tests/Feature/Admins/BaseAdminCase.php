<?php

namespace Modules\Admin\Tests\Feature\Admins;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Admin\Entities\Admin;

class BaseAdminCase extends TestCase
{
    protected $admin;

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
     * giveCreateAdminPermission
     *
     * @return void
     */
    public function giveCreateAdminPermission()
    {

        $this->admin->givePermissionTo('create admin');
    }

    /**
     * giveCreateAdminPermission
     *
     * @return void
     */
    public function giveReadAdminPermission()
    {

        $this->admin->givePermissionTo('read admin');
    }

    /**
     * giveUpdateAdminPermission
     *
     * @return void
     */
    public function giveUpdateAdminPermission()
    {

        $this->admin->givePermissionTo('update admin');
    }

    /**
     * giveDeleteAdminPermission
     *
     * @return void
     */
    public function giveDeleteAdminPermission()
    {

        $this->admin->givePermissionTo('delete admin');
    }
}
