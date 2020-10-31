<?php

namespace Modules\User\Tests\Feature\Ad;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase
{

    public function test_see_create_ad()
    {
        $response = $this->get(route('user.ad.create'));

        $response->assertStatus(200);
    }
}
