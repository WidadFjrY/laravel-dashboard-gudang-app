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
        $categoryId = [1, 2, 3];


        return [
            'SKU' => rand(1, 100000),
            'category_id' => $this->faker->randomElement($categoryId),
            'unit_id' => $this->faker->randomElement($categoryId),
            'name' => $this->faker->word(),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac risus euismod, facilisis libero ac, ultrices odio. Quisque sit amet lectus in libero dictum varius ac et odio. Ut ac elit eget nunc fringilla volutpat. Maecenas sed ligula vel velit vulputate aliquet in id enim. Curabitur id urna at justo tincidunt tristique.',
            'price' => rand(5, 10),
            'stock' => rand(1, 100),
            'weight' => 500,
            'url_picture' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=1760&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
        ];
    }
}
