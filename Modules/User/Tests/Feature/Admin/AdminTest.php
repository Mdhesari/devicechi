<?php

namespace Modules\User\Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    public function test_guest_user_is_redirected()
    {

        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('login'));
    }
}
