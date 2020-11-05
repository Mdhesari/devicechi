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

        $brands = [
            "10.or",
            "Apple",
            "Asus",
            "Blackberry",
            "Coolpad",
            "Gionee",
            "Google",
            "Honor",
            "HTC",
            "Huawei",
            "Infinix",
            "InFocus",
            "Intex",
            "Karbonn",
            "Lava",
            "LeEco",
            "Lenovo",
            "LG",
            "Lyf",
            "Micromax",
            "Motorola",
            "Nokia",
            "OnePlus",
            "Oppo",
            "Other",
            "Panasonic",
            "Poco",
            "Realme",
            "Redmi",
            "Samsung",
            "Sony",
            "Tecno",
            "Vivo",
            "Xiaomi",
            "Xolo",
            "Yu",
        ];

        $db_brands = [];

        foreach ($brands as $brand) {

            $db_brands[]['name'] = $brand;
        }

        DB::table('phone_brands')->insert($db_brands);

    }
}
