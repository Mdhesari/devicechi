<?php

namespace Modules\User\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Entities\Ad\AdContactType;
use User\Database\Factories\AdFactory;

class AdContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdFactory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'contact_type_id' => AdContactType::all()->random()->id,
            'value' => 'test_value',
        ];
    }
}
