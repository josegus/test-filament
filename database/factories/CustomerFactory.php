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

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName . ' ' . $this->faker->lastName,
            'email' => $this->faker->email,
            'phone' => $this->faker->numerify('7#######'),
            'description' => $this->faker->optional()->paragraph(),
            'address' => $this->faker->address,
            'company' => $this->faker->randomElement(['company_a', 'company_b']),
            'percentage_discount' => $this->faker->optional()->randomFloat(0, 0, 50),
            'is_affiliate' => $this->faker->boolean,
            'birthday' => $this->faker->dateTimeInInterval('-30 years', '+10 years'),
        ];
    }
}
