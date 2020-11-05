<?php

namespace Modules\User\Tests\Unit;

use Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Database\Seeders\PhoneBrandTableSeeder;

class PhoneBrandSeedTest extends TestCase
{
    public function test_if_can_seed_brands()
    {

        $this->seed(PhoneBrandTableSeeder::class);

        $this->assertDatabaseCount('phone_brands', 36);
    }
}
