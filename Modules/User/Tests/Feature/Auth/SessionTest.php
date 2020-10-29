<?php

namespace Modules\User\Tests\Feature\Auth;

use DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Entities\User;

class SessionTest extends TestCase
{

    public function test_ensure_required_sessions_are_stored_after_register_request()
    {
        $phone_number = '9370038157';

        $phone_code = '+98';

        $response = $this->post(route('user.auth'), [
            'phone' => $phone_number,
            'phone_country_code' => $phone_code,
        ]);

        $response
            ->assertSessionHas('verification_code')
            ->assertSessionHas('phone');
    }

    public function test_ensure_verification_code_is_hashed()
    {

        $phone_number = '9370038157';

        $phone_code = '+98';

        $response = $this->post(route('user.auth'), [
            'phone' => $phone_number,
            'phone_country_code' => $phone_code,
        ]);

        $response->assertRedirect()
            ->assertSessionHasNoErrors()
            ->assertSessionHas('verification_code');

        $verification_code = session('verification_code');

        $this->assertTrue($this->isNumberHashed($verification_code));
    }

    private function isNumberHashed($number)
    {

        $number_info = password_get_info(strval($number));

        return $number_info['algo'] != 0;
    }

    public function test_user_should_fail_register_and_login_with_invalid_code()
    {

        $phone_number = '9370038157';

        $phone_code = '+98';

        $response = $this->post(route('user.auth'), [
            'phone' => $phone_number,
            'phone_country_code' => $phone_code,
        ]);

        $response->assertRedirect()
            ->assertSessionHasNoErrors()
            ->assertSessionHas('verification_code');


        $response = $this->post(route('user.verify', [
            'code' => '_invalid_code_',
        ]));

        $response->assertRedirect()->assertSessionHasErrors();
    }

    public function test_user_can_register_and_login()
    {

        $phone_number = '9370038157';

        $phone_code = '+98';

        $response = $this->post(route('user.auth'), [
            'phone' => $phone_number,
            'phone_country_code' => $phone_code,
        ]);

        // $response->dumpSession();

        $response->assertRedirect()
            ->assertSessionHasNoErrors()
            ->assertSessionHas('verification_code');

        $code = session('test_code');

        $response = $this->post(route('user.verify', [
            'code' => $code,
        ]));

        $response->assertRedirect(route('user.dashboard'))->assertSessionHasNoErrors()
            ->assertSessionHas('ok');

        $user = User::where('phone', $phone_number)->first();

        $this->assertNotNull($user);

        // $response->dumpSession();

    }

    public function test_if_user_can_logout() {

        
    }
}
