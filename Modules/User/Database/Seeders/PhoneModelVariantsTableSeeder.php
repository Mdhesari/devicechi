<?php

namespace Modules\User\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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

        $phone_variants = config('user.phone_variants');

        $db_model = [];

        if (empty($phone_variants))
            return 0;

        DB::table('phone_variants')->truncate();

        foreach ($phone_variants as $variant) {

            $model = DB::table('phone_models')->whereName($variant['model'])->first();

            if (!$model) {
                $this->error('unable to seed variants without model');
                throw new PhoneVariantUnableToSeedWithoutModel;
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
