<?php

namespace Modules\User\Tests\Feature\Auth;

use DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{

    public function test_guest_user_is_redirected()
    {

        $response = $this->get(route('user.dashboard'));

        $response->assertRedirect(route('user.login'));
    }
}
