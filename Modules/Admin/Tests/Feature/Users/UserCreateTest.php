<?php

namespace Modules\Admin\Tests\Feature\Users;

use App\Models\MainUser;
use Illuminate\Auth\Events\Registered;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Admin\Entities\User;
use Modules\Admin\Notifications\sendPasswordToUser;
use Notification;

class UserCreateTest extends BaseUsersCase
{
    /**
     * Unathorized cant view create user page
     *
     * @return void
     * @test
     */
    public function admin_with_no_permission_should_be_forbidden_to_create_user()
    {
        $response = $this->get(route('admin.users.add'));

        $response->assertForbidden();
    }

    /**
     * Authorized Can view create user page
     *
     * @return void
     * @test
     */
    public function can_authorized_see_create_page()
    {
        $this->giveCreateUserPermission();

        $response = $this->get(route('admin.users.add'));

        $response->assertSuccessful()
            ->assertSee('Create New User');
    }

    /**
     * Authorized Can view create user page
     *
     * @return void
     * @test
     */
    public function can_authorized_create_user()
    {
        $this->giveCreateUserPermission();

        $current_count = MainUser::count();

        $data = MainUser::factory()->make()->toArray();

        $data['password_confirmation'] = $data['password'] = random_password();

        $this->expectsEvents(Registered::class);

        $response = $this->post(
            route('admin.users.add'),
            $data
        );

        $response->assertSessionHasNoErrors()
            ->assertSessionHas('success')
            ->assertRedirect();

        $this->assertEquals(++$current_count, MainUser::count());
    }

    /**
     * Authorized Can view create user page
     *
     * @return void
     * @test
     * TODO feature tests for user notifications
     */
    // public function new_user_recieves_email()
    // {
    //     $this->giveCreateUserPermission();

    //     $data = MainUser::factory()->make()->toArray();

    //     $data['password_confirmation'] = $data['password'] = random_password();

    //     $response = $this->post(
    //         route('admin.users.add'),
    //         $data
    //     );

    //     $response->assertSessionHasNoErrors()
    //         ->assertSessionHas('success')
    //         ->assertRedirect();

    //     Notification::assertSentTo(
    //         MainUser::whereEmail($data['email'])->first(),
    //         sendPasswordToUser::class
    //     );
    // }
}
