<?php

namespace Modules\Admin\Tests\Feature\Users;

use App\Models\MainUser;
use Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserUpdateTest extends BaseUsersCase
{

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = MainUser::factory()->create();

        $this->from(route('admin.users.edit', $this->user));
    }

    /**
     * Unathorized cant update user
     *
     * @return void
     * @test
     */
    public function unathorized_cant_update_user()
    {
        $response = $this->get(route('admin.users.edit', $this->user), []);

        $response->assertForbidden();
    }

    /**
     * Authorized can update user
     *
     * @return void
     * @test
     */
    public function authorized_can_update_user()
    {
        $this->giveCreateUserPermission();

        $data = [
            'name' => $this->faker->name
        ];

        $response = $this->post(route('admin.users.edit', $this->user), $data);

        $this->user->refresh();

        $response->assertSessionHasNoErrors()
            ->assertSessionHas('success')
            ->assertRedirect(route('admin.users.edit', $this->user));

        $this->assertEquals($data['name'], $this->user->name);
    }

    /**
     * Authorized can update user
     *
     * @return void
     * @test
     */
    public function authorized_can_update_user_password()
    {
        $this->giveCreateUserPermission();

        $data = [
            'password' => $password = random_password(),
            'password_confirmation' => $password
        ];

        $response = $this->post(route('admin.users.edit', $this->user), $data);

        $this->user->refresh();

        $response->assertSessionHasNoErrors()
            ->assertSessionMissing('error')
            ->assertSessionHas('success')
            ->assertRedirect(route('admin.users.edit', $this->user));

        // can login with new password
        $response = $this->postJson(route('login'), [
            'email' => $this->user->email,
            'password' => $data['password']
        ]);

        $response->assertJsonMissingValidationErrors()
            ->assertJsonStructure([
                'name',
                'email',
                'access_token',
            ]);
    }
}
