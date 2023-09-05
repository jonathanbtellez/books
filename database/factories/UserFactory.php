<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        return [
            'name' => fake()->name(),
            'number_id' => fake()->randomNumber(9, true),
            'last_name' => fake()->unique()->safeEmail(),
            'email' => fake()->unique()->safeEmail(),
            'password' => 12345678, // password
            'remember_token' => Str::random(30),
        ];
    }
}
