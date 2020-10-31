<?php

namespace Modules\User\Tests\Unit\Ad;

use App\Models\Ad;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase
{
    public function test_if_can_initialize()
    {

        $ad = new Ad;

        $ad->model_id = 1;
        $ad->save();

        $this->assertIsObject($ad);
    }
}
