<?php

namespace Modules\User\Tests\Unit\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CanRetrieveZiggyTest extends TestCase
{
    public function test_can_get_routes()
    {

        $response = $this->get(route('user.ziggy'));

        $response->dump();

        $response->assertSuccessful();
    }
}
