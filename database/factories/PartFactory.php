<?php

namespace Database\Factories;

use App\Models\Part;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Part::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => '1',
            "image" => 'images/no_image.png',
            "name_ar" => $this->faker->name(),
            "name_en" => $this->faker->name(),
            "Purchase_price" => $this->faker->numberBetween(10,100),
            "sale_price" => $this->faker->numberBetween(10,100),
        ];
    }
}
