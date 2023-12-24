<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // name product, description, price, image, category_id, and stock
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price' => $this->faker->numberBetween(1000, 100000),
            'image' => $this->faker->imageUrl(),
            'category_id' => $this->faker->numberBetween(1, 3),
            'stock' => $this->faker->numberBetween(1, 100),
        ];
    }
}
