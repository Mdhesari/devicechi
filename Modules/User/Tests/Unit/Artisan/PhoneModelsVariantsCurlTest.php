<?php

namespace Modules\User\Tests\Unit\Artisan;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Entities\PhoneModel;
use Modules\User\Entities\PhoneVariant;

class PhoneModelsVariantsCurlTest extends TestCase
{
    public function test_should_encounter_error_running_models_curl_without_brands()
    {

        $this->artisan('curl:phone_variants')
            ->expectsOutput('Start scrapping phone models data and resources...')
            ->expectsOutput('There is no models available!');
    }

    public function test_if_can_curl_variants_along_brands_and_models_using_database()
    {

        $this->assertEmpty(PhoneVariant::count());

        $this->artisan('curl:phone_brands database');
        $this->artisan('curl:phone_models database');

        $this->artisan('curl:phone_variants database')
            ->expectsOutput('Start scrapping phone models data and resources...')
            ->expectsOutput('Scrapping was successful!');

        $this->assertNotEmpty(PhoneVariant::count());
    }
}
