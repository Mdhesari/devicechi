<?php

namespace Modules\Admin\Tests\Feature\Admins;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Admin\Entities\Admin;

class AdminDeleteTest extends BaseAdminCase
{
    /**
     * Unathorized cant view delete admin page
     *
     * @return void
     * @test
     */
    public function admin_with_no_permission_should_be_forbidden_to_delete_admin()
    {
        $response = $this->delete(route('admin.admins.destroy', Admin::first()));

        $response->assertForbidden();
    }

    /**
     * Authorized Can delete admin
     *
     * @return void
     * @test
     */
    public function can_authorized_delete_admin()
    {
        $this->giveDeleteAdminPermission();

        $admins_count = Admin::count();

        $response = $this->delete(route('admin.admins.destroy', Admin::first()));

        $response->assertSessionHasNoErrors()
            ->assertSessionHas('success');

        $this->assertEquals(--$admins_count, Admin::count());
    }
}
