<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'category' => fake()->firstName(),
            'brand' => fake()->firstName(),
            'description' => fake()->paragraph(8),
            'image' => fake()->firstName().(string)time().'.jpg',
            'price' => fake()->numberBetween(0,1000),
            'rating' => fake()->numberBetween(0,5),
        ];
    }
}
