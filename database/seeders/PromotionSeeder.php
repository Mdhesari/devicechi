<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $promotions = json_decode(file_get_contents(predata_path('/promotions.json')), true);

        foreach ($promotions as $promotion) {
            DB::table('promotions')->insert($promotion);
        }
    }
}
