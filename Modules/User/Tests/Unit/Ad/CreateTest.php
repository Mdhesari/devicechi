<?php

namespace Modules\User\Tests\Unit\Ad;

use App\Models\Ad;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Entities\User;

class CreateTest extends TestCase
{
    public function test_if_can_initialize()
    {

        $user = User::factory()->create();

        $ad = new Ad;
        $ad->model_id = 1;

        $user->ads()->save($ad);

        $this->assertDatabaseCount('ads', 1);
    }
}
