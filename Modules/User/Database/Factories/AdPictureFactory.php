<?php

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Entities\AdPicture;

class AdPictureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdPicture::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $number = rand(1, 10);

        return [
            'url' => "images/{$number}.jpg",
        ];
    }
}
