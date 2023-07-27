<?php

namespace Modules\Admin\Tests\Feature\Users;

use App\Models\MainUser;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mail;
use Modules\Admin\Entities\User;

class UserDeleteTest extends BaseUsersCase
{
    /**
     * Unathorized cant view delete user page
     *
     * @return void
     * @test
     */
    public function admin_with_no_permission_should_be_forbidden_to_delete_user()
    {
        $response = $this->delete(route('admin.users.destroy', User::first()));

        $response->assertForbidden();
    }

    /**
     * Authorized Can delete user
     *
     * @return void
     * @test
     */
    public function can_authorized_delete_user()
    {
        $this->giveDeleteUserPermission();

        $users_count = User::count();

        $response = $this->delete(route('admin.users.destroy', User::first()));

        $response->assertSessionHasNoErrors()
            ->assertSessionHas('success');

        $this->assertEquals(--$users_count, User::count());
    }
}
