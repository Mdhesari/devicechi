<?php

namespace Modules\User\Database\Seeders;

use DB;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\PhoneBrand;
use Modules\User\Entities\PhoneModel;
use Modules\User\Exceptions\PhoneModelUnableToeSeedWithoutBrands;

class PhoneModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $models = config('user.phone_models');

        $db_models = [];

        PhoneModel::truncate();

        foreach ($models as $model) {

            $brand = PhoneBrand::whereName($model['brand_name'])->first();

            if (is_null($brand)) throw new PhoneModelUnableToeSeedWithoutBrands("Cannot create model with nulled brand");

            $db_models[] = [
                'brand_id' => $brand->id,
                'name' => $model['name'],
            ];
        }

        PhoneModel::insert($db_models);
    }
}
