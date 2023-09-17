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
        $cats = ['car','bike','truck','bus'];
        $brands = ['honda','toyota','ford','audi'];
        $images = ['Cleora1694842308.jpg','Eryn1694842308.jpg','Kelvin1694842308.jpg'];
        return [
            'name' => fake()->firstName(),
            'category' => $cats[rand(0,3)],
            'brand' => $brands[rand(0,3)],
            'description' => fake()->paragraph(8),
            'image' => rand(1,3)==2?"":$images[rand(0,2)], // not storing image for all
            'price' => fake()->numberBetween(0,1000),
            'rating' => fake()->numberBetween(0,5),
            'stock' => fake()->numberBetween(0,100)
        ];
    }
}
