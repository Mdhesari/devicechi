<?php

namespace Modules\User\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\PhoneModel;
use Modules\User\Exceptions\PhoneVariantUnableToSeedWithoutModel;

class PhoneModelVariantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $phone_variants = json_decode(file_get_contents(predata_path('/variants.json')), true);

        $db_model = [];

        if (empty($phone_variants))
            return 0;

        DB::table('phone_variants')->truncate();

        foreach ($phone_variants as $variant) {
            $model = DB::table('phone_models')->where('name', $variant['model'])->first();

            if (!$model) {
                dump($variant['model']);
                // throw new PhoneVariantUnableToSeedWithoutModel;
                continue;
            }

            $db_model[] = [
                'phone_model_id' => $model->id,
                'ram' => trim($variant['ram']),
                'storage' => trim($variant['storage']),
            ];
        }

        DB::table('phone_variants')->insert($db_model);
    }
}
