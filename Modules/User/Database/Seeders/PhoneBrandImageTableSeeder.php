<?php

namespace Modules\User\Database\Seeders;

use DB;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Exceptions\PhoneBrandImageNotUpdated;
use Modules\User\Exceptions\PhoneBrandNotFound;

class PhoneBrandImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $brands = config('user.phone_brands_image');

        foreach ($brands as $brand_image) {

            $brand = DB::table('phone_brands')->whereName($brand_image['name'])->first();

            if (is_null($brand)) {

                report(new Exception('brand not found'));
                throw new PhoneBrandNotFound('Phone brand not found while seeding phone brand images.');
            }

            DB::table('phone_brands')->whereId($brand->id)->update([
                'picture_path' => $brand_image['picture_path'],
            ]);
        }
    }
}
