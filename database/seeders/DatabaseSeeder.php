<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Team\Database\Seeders\TeamDatabaseSeeder;
use Modules\User\Database\Seeders\UserDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserDatabaseSeeder::class);
        // $this->call(TeamDatabaseSeeder::class);
    }
}
