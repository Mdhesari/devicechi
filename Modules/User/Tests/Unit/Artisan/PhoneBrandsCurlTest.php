<?php

namespace Modules\User\Tests\Unit\Artisan;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Log;
use App\Models\PhoneBrand;

class PhoneBrandsCurlTest extends TestCase
{

    public function test_if_can_curl_brands_using_default_type_log()
    {

        $url = 'https://www.recycledevice.com/sell-mobile';

        exec('rm ' . storage_path('logs/*.log'));

        $this->assertFalse(file_exists(storage_path('logs/laravel.log')));

        $this->artisan('curl:phone_brands --url=' . $url)
            ->expectsOutput('Start scrapping... ' . $url . ' url.')
            ->expectsOutput('Srapping items...')
            ->expectsOutput('Successfully scrapped data and resources.');

        $this->assertTrue(file_exists(storage_path('logs/laravel.log')));
    }

    public function test_if_can_curl_brands_using_database()
    {

        $url = 'https://www.recycledevice.com/sell-mobile';

        $phone_brands_count = PhoneBrand::count();

        $this->assertEquals(0, $phone_brands_count);

        $this->artisan('curl:phone_brands database --url=' . $url)
            ->expectsOutput('Start scrapping... ' . $url . ' url.')
            ->expectsOutput('Srapping items...')
            ->expectsOutput('Successfully scrapped data and resources.');

        $phone_brands_count = PhoneBrand::count();

        $this->assertNotEquals(0, $phone_brands_count);
    }

    public function test_if_config_is_updated_using_database()
    {

        config([
            'user.phone_brands' => [],
        ]);

        $this->assertEmpty(config('user.phone_brands'));

        $this->artisan('curl:phone_brands database')
            ->expectsOutput('Successfully scrapped data and resources.');

        $this->assertNotEmpty(config('user.phone_brands'));
    }

    /* Takes a lot of resources to consume */
    // public function test_if_images_are_stored()
    // {

    //     exec('rm -r ' . public_path('images/brands'));

    //     $this->assertFalse(file_exists(public_path('images/brands')));

    //     $this->artisan('curl:phone_brands database')
    //         ->expectsOutput('Successfully scrapped data and resources.');

    //     $this->assertTrue(file_exists(public_path('images/brands')));
    // }
}
