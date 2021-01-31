<?php

namespace Modules\Admin\Tests\Feature\Users;

use App\Models\MainUser;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Admin\Tests\Feature\Users\BaseUsersCase;

class UserReadTest extends BaseUsersCase
{
    /**
     * Unathorized cant see user
     *
     * @return void
     * @test
     */
    public function unathorized_cant_see_user()
    {
        $response = $this->get(route('admin.users.show', MainUser::first()));

        $response->assertForbidden();
    }

    /**
     * Authorized can see user
     *
     * @return void
     * @test
     */
    public function authorized_can_see_user()
    {
        $this->giveReadUserPermission();

        $user = MainUser::first();

        $response = $this->get(route('admin.users.show', $user));

        $response->assertSuccessful()
            ->assertSee($user->name);
    }
}
