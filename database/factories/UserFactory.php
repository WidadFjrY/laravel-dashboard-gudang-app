<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $role = ['Admin', 'User'];
        return [
            // 'email' => $this->faker->email(),
            'email' => 'widadzdadz@gmail.com',
            'username' => 'wid_dad',
            'password' => Hash::make('plmokn123'),
            // 'role' => $this->faker->randomElement($role),
            'role' => 'Admin',
            // 'name' => $this->faker->name('Male'),
            'name' => 'Widad Al Fajri',
            'url_picture' => 'profile-user/portrait.jpg'
        ];
    }
}
