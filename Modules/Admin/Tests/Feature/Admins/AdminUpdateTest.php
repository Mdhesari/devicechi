<?php

namespace Modules\Admin\Tests\Feature\Admins;

use Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Admin\Entities\Admin;

class AdminUpdateTest extends BaseAdminCase
{

    protected $guest_admin;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->guest_admin = Admin::factory()->create();

        $this->from(route('admin.admins.edit', $this->guest_admin));
    }

    /**
     * Unathorized cant update user
     *
     * @return void
     * @test
     */
    public function unathorized_cant_update_admin()
    {
        $response = $this->get(route('admin.admins.edit', $this->guest_admin));

        $response->assertForbidden();
    }

    /**
     * Authorized can update user
     *
     * @return void
     * @test
     */
    public function authorized_can_update_admin()
    {
        $this->giveUpdateAdminPermission();

        $data = [];

        $data['name'] = $this->faker->name;

        $response = $this->post(route('admin.admins.edit', $this->guest_admin), $data);

        $this->guest_admin->refresh();

        $response->assertSessionHasNoErrors()
            ->assertSessionHas('success')
            ->assertRedirect(route('admin.admins.edit', $this->guest_admin));

        $this->assertEquals($data['name'], $this->guest_admin->name);
    }

    /**
     * Authorized can update user
     *
     * @return void
     * @test
     */
    public function authorized_can_update_admin_password()
    {
        $this->giveUpdateAdminPermission();

        $data = [];

        $data['password_confirmation'] = $data['password'] = random_password();

        $response = $this->post(route('admin.admins.edit', $this->guest_admin), $data);

        $this->guest_admin->refresh();

        $response->assertSessionHasNoErrors()
            ->assertSessionMissing('error')
            ->assertSessionHas('success')
            ->assertRedirect(route('admin.admins.edit', $this->guest_admin));

        $this->post(route('admin.logout'));

        // can login with new password
        $response = $this->post(route('admin.login'), [
            'email' => $this->guest_admin->email,
            'password' => $data['password']
        ]);

        $response->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertAuthenticatedAs($this->guest_admin);
    }
}
