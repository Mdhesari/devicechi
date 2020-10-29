<?php

namespace Modules\User\Tests\Feature\Auth;

use DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Entities\User;

class UserTest extends TestCase
{

    public function test_guest_user_is_redirected()
    {

        $response = $this->get(route('user.dashboard'));

        $response->assertRedirect(route('user.login'));
    }

    public function test_ensure_user_column_phone_verified_at_updates_after_true_verification()
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

        $this->assertNotNull($user->phone_verified_at);
    }
}
