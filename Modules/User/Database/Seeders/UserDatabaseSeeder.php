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
        $this->call(PhoneModelTableSeeder::class);
    }
}
