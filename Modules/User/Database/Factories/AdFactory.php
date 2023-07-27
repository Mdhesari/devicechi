<?php

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ad;
use Faker\Factory as Faker;
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
            'title' => $this->faker->sentence,
            'description' => $this->faker->text,
            'phone_model_id' => 1,
            'phone_model_variant_id' => 1,
            'price' => 120000,
            'phone_age_id' => 1,
            'state_id' => 1,
            'phone_model_id' => PhoneModel::first()->id,
            'user_id' => 1,
            'status' => Ad::STATUS_AVAILABLE,
            'is_published' => true
        ];
    }
}
