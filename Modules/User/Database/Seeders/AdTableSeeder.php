<?php

namespace Modules\User\Database\Seeders;

use App\Models\Ad;
use App\Models\Ad\AdContact;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Modules\User\Entities\AdPicture;

class AdTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        Model::unguard();

        Ad::factory()->has(AdPicture::factory(), 'pictures')
            ->has(AdContact::factory(), 'contacts')
            ->count(10)
            ->create();

        $ads = Ad::factory()->has(AdPicture::factory(), 'pictures')
            ->has(AdContact::factory(), 'contacts')
            ->count(3)
            ->make();

        $ads->map(function ($ad) {

            $ad->is_pro = true;
            $ad->save();
        });
    }
}
