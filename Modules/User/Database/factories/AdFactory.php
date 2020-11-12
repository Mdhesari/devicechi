<?php

namespace User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Entities\Ad;
use Modules\User\Entities\PhoneModel;

class AdFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phone_model_id' => PhoneModel::first()->id,
            'user_id' => 1,
        ];
    }
}
