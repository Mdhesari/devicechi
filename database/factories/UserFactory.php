<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phone' => join(['+98', rand(3, 9), rand(30, 40), rand(1000, 9999), rand(10, 99), rand(10, 99)]),
            'remember_token' => Str::random(10),
        ];
    }
}
