<?php

namespace Modules\User\Database\Seeders;

use App\Models\Ad;
use App\Models\Ad\AdContact;
use Exception;
use Faker\Factory;
use Faker\Generator;
use Http;
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

        $picture_api = "https://bing-image-search1.p.rapidapi.com/images/search";
        $pictures = Http::withHeaders([
            "x-rapidapi-key" => "5TaePplKOvmshE8Wa4MDs4aBgakHp197xCsjsnnFR5U2JxnipT",
            "x-rapidapi-host" => "bing-image-search1.p.rapidapi.com",
            "useQueryString" => true
        ])->get($picture_api, [
            'q' => 'smartphone'
        ]);

        $pictures = collect($pictures->json()['value']);

        for ($i = 0; $i < 20; $i++) {

            $picture = $pictures->random();

            $ad = Ad::factory()
                ->has(AdContact::factory(), 'contacts')
                ->create();

            try {
                $media = $ad->addMediaFromUrl($picture['contentUrl'])->toMediaCollection();
                $ad->media()->first()->setCustomProperty('active', true)->save();
            } catch (Exception $e) {
                report($e);
            }
        }

        for ($i = 0; $i < 3; $i++) {

            $picture = $pictures->random();

            $ad = Ad::factory()
                ->has(AdContact::factory(), 'contacts')
                ->create();

            try {
                $ad->addMediaFromUrl($picture['contentUrl'])->toMediaCollection();
                $ad->media()->first()->setCustomProperty('active', true)->save();
            } catch (Exception $e) {
                report($e);
            }

            $ad->is_pro = true;
            $ad->save();
        }
    }
}
