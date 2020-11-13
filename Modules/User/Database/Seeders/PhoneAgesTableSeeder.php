<?php

namespace Modules\User\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PhoneAgesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $ages = config('user.phone_ages');

        DB::table('phone_ages')->truncate();

        DB::table('phone_ages')->insert($ages);
        // $this->call("OthersTableSeeder");
    }
}
