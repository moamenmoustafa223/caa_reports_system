<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;



    public function definition()
    {
        return [
            "user_id" => '1',
            "name" => $this->faker->name(),
            "id_no" => $this->faker->numberBetween(100, 9999),
            "phone" => $this->faker->phoneNumber(),
            "email" => $this->faker->email(),
            "address" => $this->faker->address(),
            "nationality" => $this->faker->century(),
        ];
    }
}
