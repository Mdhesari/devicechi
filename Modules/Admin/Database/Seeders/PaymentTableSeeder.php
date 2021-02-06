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

        if (!app()->environment('local')) return;

        Payment::factory()->count(20)->create();
    }
}
