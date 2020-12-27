<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Database\Seeders\AdContactTypeTableSeeder;
use Modules\User\Entities\Ad\AdContactType;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        \Modules\User\Entities\User::factory(10)->create();

        $this->call([
            CountryStatesTableSeeder::class,
            PhoneBrandTableSeeder::class,
            PhoneBrandImageTableSeeder::class,
            PhoneModelTableSeeder::class,
            PhoneModelVariantsTableSeeder::class,
            PhoneAccessoriesTableSeeder::class,
            PhoneAgesTableSeeder::class,
            AdContactTypeTableSeeder::class,
        ]);
    }
}
