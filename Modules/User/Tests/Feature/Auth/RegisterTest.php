<?php

namespace Modules\User\Tests\Feature\Auth;

use DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;

class RegisterTest extends TestCase
{

    public function test_if_can_register()
    {

        $number = $this->generatePhoneNumber();

        $response = $this->post(route('user.auth'), [
            'phone' => $number,
        ]);

        $response->assertJson(['status' => 1]);
    }

    public function test_ensure_user_is_created_after_registeration()
    {

        $number = $this->generatePhoneNumber();

        $user = DB::table('users')->where('phone', $number)->first();

        $this->assertNull($user);

        $this->post(route('user.auth'), [
            'phone' => $number,
        ]);

        $user = DB::table('users')->where('phone', $number)->first();

        $this->assertIsObject($user);
    }

    public function test_ensure_sessions_are_stored_after_registeration()
    {

        $number = $this->generatePhoneNumber();

        $this->post(route('user.auth'), [
            'phone' => $number,
        ]);

        $response = $this->get('/');

        $response->assertSessionHas('phone');
        $response->assertSessionHas('verification_code');
    }

    public function test_validation_fail_while_registering()
    {

        $this->expectException(ValidationException::class);

        $number = '+989';

        $response = $this->post(route('user.auth'), [
            'phone' => $number,
        ]);

        $response->dumpSession();

        $response->assertJsonValidationErrors(['phone']);
    }

    private function generatePhoneNumber()
    {

        return '+989' . rand(30, 40) . rand(0000000, 9999999);
    }
}
