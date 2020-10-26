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
        $country_code = rand(1, 98);

        $response = $this->post(route('user.auth'), [
            'phone' => $number,
            'phone_country_code' => $country_code,
        ]);

        $response->assertRedirect();
    }

    public function test_ensure_user_is_created_after_registeration()
    {

        $number = $this->generatePhoneNumber();
        $country_code = rand(1, 98);

        $user = DB::table('users')->where('phone', $number)->first();

        $this->assertNull($user);

        $this->post(route('user.auth'), [
            'phone' => $number,
            'phone_country_code' => $country_code,
        ]);

        $user = DB::table('users')->where('phone', $number)->first();

        $this->assertIsObject($user);
    }

    public function test_ensure_sessions_are_stored_after_registeration()
    {

        $number = $this->generatePhoneNumber();
        $country_code = rand(1, 98);

        $this->post(route('user.auth'), [
            'phone' => $number,
            'phone_country_code' => $country_code,
        ]);

        $response = $this->get('/');

        $response->assertSessionHas('phone');
        $response->assertSessionHas('verification_code');
    }

    public function test_validation_fail_should_while_registering()
    {

        $this->expectException(ValidationException::class);

        $number = '89';
        $country_code = rand(1, 98);

        $response = $this->post(route('user.auth'), [
            'phone' => $number,
            'phone_country_code' => $country_code,
        ]);

        $response->assertJsonValidationErrors(['phone']);
    }

    private function generatePhoneNumber()
    {

        return rand(1, 9) . rand(0000000, 9999999);
    }
}
