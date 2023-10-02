<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'house_no' => fake()->numberBetween(10, 1000),
            'road_no' => fake()->numberBetween(10, 9999),
            'postal_code' => fake()->postcode(),
            'thana' => fake()->sentence(),
            'zilla' => fake()->sentence(),
            'division' => fake()->sentence(),
            'country' => fake()->country(),
            'user_id' => User::all(['id'])->random(),
        ];
    }
}
