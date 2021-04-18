<?php

namespace Database\Seeders;

use App\Models\TicketDepartment;
use Illuminate\Database\Seeder;
use Modules\Admin\Database\Seeders\AdminDatabaseSeeder;
use Modules\Main\Database\Seeders\MainDatabaseSeeder;
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
        $this->call([
            MenuSeeder::class,
            UserDatabaseSeeder::class,
            AdminDatabaseSeeder::class,
            PromotionSeeder::class,
        ]);
    }
}
