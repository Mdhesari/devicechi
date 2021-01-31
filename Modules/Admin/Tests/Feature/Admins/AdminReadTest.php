<?php

namespace Modules\Admin\Tests\Feature\Admins;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Tests\Feature\Users\BaseUsersCase;

class AdminReadTest extends BaseAdminCase
{
    /**
     * Unathorized cant see admin
     *
     * @return void
     * @test
     */
    public function unathorized_cant_see_admin()
    {
        $response = $this->get(route('admin.admins.show', Admin::first()));

        $response->assertForbidden();
    }

    /**
     * Authorized can see admin
     *
     * @return void
     * @test
     */
    public function authorized_can_see_admin()
    {
        $this->giveReadAdminPermission();

        $admin = Admin::first();

        $response = $this->get(route('admin.admins.show', $admin));

        $response->assertSuccessful()
            ->assertSee($admin->name);
    }
}
