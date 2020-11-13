<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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
        $this->call(PhoneBrandTableSeeder::class);
        $this->call(PhoneBrandImageTableSeeder::class);
        $this->call(PhoneModelTableSeeder::class);
        $this->call(PhoneModelVariantsTableSeeder::class);
        $this->call(PhoneAccessoriesTableSeeder::class);
        $this->call(PhoneAgesTableSeeder::class);
    }
}
