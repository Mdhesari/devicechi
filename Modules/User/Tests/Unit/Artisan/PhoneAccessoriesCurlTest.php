<?php

namespace Modules\User\Tests\Unit\Artisan;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Entities\PhoneAccessory;

class PhoneAccessoriesCurlTest extends TestCase
{
    public function test_if_can_curl_all()
    {

        $this->assertEmpty(PhoneAccessory::count());

        $this->artisan('curl:phone_accessories database')
            ->expectsOutput('Start scrapping accessories...')
            ->expectsOutput('Successfuly scrapped accessories...');

        $this->assertNotEmpty(PhoneAccessory::count());
    }

    public function test_if_config_is_updated_using_database()
    {

        config([
            'user.phone_accessories' => [],
        ]);

        $this->assertEmpty(config('user.phone_accessories'));

        $this->artisan('curl:phone_accessories database')
            ->expectsOutput('Start scrapping accessories...')
            ->expectsOutput('Successfuly scrapped accessories...');

        $this->assertNotEmpty(config('user.phone_models'));
    }

    public function test_if_images_are_stored()
    {

        exec('rm -r ' . public_path('images/accessories'));

        $this->assertFalse(file_exists(public_path('images/accessories')));

        $this->artisan('curl:phone_accessories database')
            ->expectsOutput('Successfuly scrapped accessories...');

        $this->assertTrue(file_exists(public_path('images/accessories')));
    }
}
