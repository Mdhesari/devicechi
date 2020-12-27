<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Ad\AdContactType;

class AdContactTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $contact_types = config('user.contact_types');

        AdContactType::truncate();

        foreach ($contact_types as $arr) {

            $type = new AdContactType;
            $type->name = $arr['name'];
            $type->description = $arr['description'];
            $type->data = isset($arr['data']) ? $arr['data'] : [];
            $type->save();
        }

        // AdContactType::create($contact_types);
    }
}
