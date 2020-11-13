<?php

namespace Modules\User\Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Modules\User\Entities\User;

class UserTest extends TestCase
{
    public function test_should_not_get_user_without_login()
    {

        $response = $this->get(route('api.auth.user'));

        $response->assertRedirect();
    }

    public function test_should_get_user_with_login()
    {


        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->get(route('api.auth.user'));

        $response->assertSuccessful()
            ->assertSessionDoesntHaveErrors();
    }
}
