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
    public function definition()
    {
        // title, slug, price, image, user_id
        $title = $this->faker->sentence(3);
        return [
            'title' => $title,
            'slug' => \Str::slug($title),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'image' => '',
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
