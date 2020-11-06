<?php

namespace Modules\User\Tests\Unit\Artisan;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Entities\PhoneModel;

class PhoneModelsCurlTest extends TestCase
{

    public function test_should_encounter_error_running_models_curl_without_brands()
    {

        $this->artisan('curl:phone_models')
            ->expectsOutput('Start scrapping phone models data and resources...')
            ->expectsOutput('There is no brands available!');
    }

    public function test_if_can_curl_models_along_brands_using_database()
    {

        $this->assertEmpty(PhoneModel::count());

        $this->artisan('curl:phone_brands database');

        $this->artisan('curl:phone_models database')
            ->expectsOutput('Start scrapping phone models data and resources...')
            ->expectsOutput('Scrapping was successful!');

        $this->assertNotEmpty(PhoneModel::count());
    }

    public function test_if_config_is_updated_using_database()
    {

        config([
            'user.phone_models' => [],
        ]);

        $this->assertEmpty(config('user.phone_models'));

        $this->artisan('curl:phone_brands database');

        $this->artisan('curl:phone_models database')
            ->expectsOutput('Start scrapping phone models data and resources...')
            ->expectsOutput('Scrapping was successful!');

        $this->assertNotEmpty(config('user.phone_models'));
    }
}
