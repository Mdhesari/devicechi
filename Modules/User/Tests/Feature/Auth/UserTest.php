<?php

namespace Modules\User\Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{

    public function test_if_can_register()
    {
        $response = $this->post(route('user.auth'), [
            'phone_number' => '+989370038157',
        ]);

        $response->assertJson(['status' => 'ok']);
    }

    public function test_ensure_sessions_are_stored_after_registeration()
    {

        $this->post(route('user.auth'), [
            'phone_number' => '+989370038157',
        ]);

        $response = $this->get('/');

        $response->assertSessionHas('phone_number');
        $response->assertSessionHas('verification_code');
    }
}
