<?php

namespace Modules\Admin\Tests\Feature\Admins;

use App\Models\MainUser;
use App\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Notifications\SendPasswordToUser;
use Notification;

class AdminCreateTest extends BaseAdminCase
{

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->from(route('admin.admins.add'));
    }

    /**
     * Unathorized cant view create user page
     *
     * @return void
     * @test
     */
    public function admin_with_no_permission_should_be_forbidden()
    {

        $response = $this->get(route('admin.admins.add'));

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
        $this->giveCreateAdminPermission();

        $response = $this->get(route('admin.admins.add'));

        $response->assertSuccessful()
            ->assertSee('Create Admin User');
    }

    /**
     * Authorized Can view create user page
     *
     * @return void
     * @test
     */
    public function can_authorized_create_admin()
    {
        $this->giveCreateAdminPermission();

        $admins_count = Admin::count();

        $data = Admin::factory()->make()->toArray();

        $data['password_confirmation'] = $data['password'] = random_password();
        $data['role'] = Role::first()->name;

        $response = $this->post(route('admin.admins.add'), $data);

        $response->assertSessionHasNoErrors()
            ->assertSessionHas('success')
            ->assertRedirect(route('admin.admins.add'));

        $this->assertEquals(++$admins_count, Admin::count());
    }


    /**
     * New admin recieves email
     *
     * @return void
     * @test
     */
    public function new_admin_recieves_email()
    {
        $this->giveCreateAdminPermission();

        $data = [
            'name' => 'ali',
            'email' => $email = 'ali@gmail.com',
            'password' => "12345677",
            'role' => Role::first()->name
        ];

        $data['password_confirmation'] = $data['password'];

        $response = $this->post(route('admin.admins.add'), $data);

        $response->assertSessionHasNoErrors()
            ->assertSessionHas('success')
            ->assertRedirect(route('admin.admins.add'));

        Notification::assertSentTo(
            Admin::where('email', $email)->first(),
            SendPasswordToUser::class,
        );
    }
}
