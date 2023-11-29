<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RecommendedSource>
 */
class RecommendedSourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'source_type' => $this->faker->randomElement(['police', 'prison', 'immigration']),
            'source_address' => $this->faker->address,
        ];
    }
}
