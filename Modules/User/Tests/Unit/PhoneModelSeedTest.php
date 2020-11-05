<?php

namespace Modules\User\Tests\Unit;

use Exception;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Database\Seeders\PhoneBrandTableSeeder;
use Modules\User\Database\Seeders\PhoneModelTableSeeder;
use Modules\User\Exceptions\PhoneModelUnableToeSeedWithoutBrands;

class PhoneModelSeedTest extends TestCase
{
    public function test_if_throws_exception_without_seeding_brands_first()
    {

        $this->expectException(PhoneModelUnableToeSeedWithoutBrands::class);

        $this->seed(PhoneModelTableSeeder::class);

        $this->assertDatabaseCount('phone_models', 0);
    }

    public function test_if_can_seed_models_after_brands()
    {

        $this->seed(PhoneBrandTableSeeder::class);
        $this->seed(PhoneModelTableSeeder::class);

        $this->assertDatabaseCount('phone_models', 1481);
    }
}
