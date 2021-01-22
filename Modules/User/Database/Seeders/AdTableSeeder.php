<?php

namespace Modules\User\Database\Seeders;

use App\Models\Ad;
use App\Models\Ad\AdContact;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

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

        $ads = Ad::factory()
            ->has(AdContact::factory(), 'contacts')
            ->count(3)
            ->create();

        $picture = "https://static.toiimg.com/photo/73078527.cms";

        $ads->map(function (Ad $ad) use ($picture) {

            $ad->addMediaFromUrl($picture)->toMediaCollection($ad::PICTURES_COLLECTION);
        });

        $ads = Ad::factory()
            ->has(AdContact::factory(), 'contacts')
            ->count(3)
            ->make();

        $ads->map(function (Ad $ad) use ($picture) {

            $ad->addMediaFromUrl($picture)->toMediaCollection($ad::PICTURES_COLLECTION);
            $ad->is_pro = true;
            $ad->save();
        });
    }
}
