<?php

namespace Modules\User\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Brand;

class PhoneBrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $brands = config('user.phone_brands');

        $db_brands = [];

        DB::table('phone_brands')->truncate();

        foreach ($brands as $brand) {

            $db_brands[]['name'] = $brand;
        }

        DB::table('phone_brands')->insert($db_brands);
    }
}
