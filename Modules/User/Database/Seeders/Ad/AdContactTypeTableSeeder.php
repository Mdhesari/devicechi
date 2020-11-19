<?php

namespace Modules\User\Database\Seeders\Ad;

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

        AdContactType::insert($contact_types);
    }
}
