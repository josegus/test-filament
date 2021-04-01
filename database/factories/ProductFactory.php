<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $name = str_replace('.', '', $this->faker->sentence($maxWords = rand(3, 5))),
            'slug' => Str::slug($name),
            'description' => $this->faker->optional(75)->paragraph,
            'price' => $price = $this->faker->randomFloat(2, 50, 500),
            'offer_price' => $offerPrice = $this->faker->optional()->randomFloat(2, 40, $price),
            'offer_limit' => $offerPrice
                ? $this->faker->dateTimeInInterval('+7 days', '+5 days')
                : null,
            'is_visible' => $this->faker->boolean(75),
        ];
    }
}
