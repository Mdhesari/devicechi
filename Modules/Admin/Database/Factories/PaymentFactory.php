<?php

namespace Modules\Admin\Database\Factories;

use App\Models\Payment\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Admin\Entities\User;
use Str;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => rand(1000, 99999),
            'user_id' => User::pluck('id')->random(),
            'status' => $status = rand(0, 3),
            'verified_at' => $status == 1 ? now()->addMinutes(5) : null,
            'verified_code' => $status == 1 ? Str::random() : null,
        ];
    }
}
