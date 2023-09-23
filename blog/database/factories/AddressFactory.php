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
            'house_no' => fake()->sentence(),
            'road_no' => fake()->numberBetween(10, 1999),
            'postal_code' => fake()->postcode(),
            'thana' => fake()->sentence(),
            'zilla' => fake()->sentence(),
            'division' => fake()->sentence(),
            'country' => fake()->country(),
            'user_id' => User::all(['id'])->random(),
        ];
    }
}
