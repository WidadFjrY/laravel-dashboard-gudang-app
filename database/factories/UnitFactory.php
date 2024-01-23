<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unit>
 */
class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $unitOptions = ['Liter', 'Karung', 'Item'];
        return [
            'name' => $this->faker->randomElement($unitOptions),
            'slug' => strtolower($this->faker->randomElement($unitOptions))
        ];
    }
}
