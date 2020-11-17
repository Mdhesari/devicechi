<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\City;
use Modules\User\Entities\CityState;
use Modules\User\Entities\Country;

class CountryStatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $countries = json_decode(file_get_contents(__DIR__ . '/../iran-cities/json/iranstates.json'), true);

        foreach ($countries as $country) {

            $country_model = new Country;

            $country_model->name = $country['country'];
            $country_model->iso = $country['iso'];
            $country_model->domain = $country['domain'];
            $country_model->currency = $country['currency'];
            $country_model->phone_code = $country['phone_code'];
            $country_model->save();

            $country_id = $country_model->id;

            foreach ($country['cities'] as $cityName => $states) {

                $city = new City;
                $city->name = $cityName;
                $city->country_id = $country_id;
                $city->save();

                $city_id = $city->id;

                foreach ($states as $stateName) {

                    $state = new CityState;
                    $state->name = $stateName;
                    $state->city_id = $city_id;
                    $state->save();
                }
            }
        }
    }
}
