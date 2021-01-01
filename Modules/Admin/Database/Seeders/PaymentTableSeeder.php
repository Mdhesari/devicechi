<?php

namespace Modules\Admin\Database\Seeders;

use App\Models\Payment\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Payment::factory()->count(20)->create();
    }
}
