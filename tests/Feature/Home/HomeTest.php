<?php

namespace Tests\Feature\Home;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CanSeeLoginFormTest extends TestCase
{
    public function test_see_home()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
