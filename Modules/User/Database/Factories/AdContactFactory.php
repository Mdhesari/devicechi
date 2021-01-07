<?php

namespace Modules\User\Database\Factories;

use App\Models\Ad\AdContact;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ad\AdContactType;
use User\Database\Factories\AdFactory;

class AdContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdContact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'contact_type_id' => $type = AdContactType::all()->random()->id,
            'value' => $type == AdContactType::TYPE_EMAIL ? $this->faker->email : $this->faker->phoneNumber,
        ];
    }
}
