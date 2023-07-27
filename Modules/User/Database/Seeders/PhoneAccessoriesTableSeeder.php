<?php

namespace Modules\User\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PhoneAccessoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $accessories = config('user.phone_accessories');

        $accessories = json_decode(file_get_contents(predata_path('/accessories.json')), true);

        DB::table('phone_accessories')->truncate();

        DB::table('phone_accessories')->insert($accessories);
    }
}
