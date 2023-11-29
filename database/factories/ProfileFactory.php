<?php

namespace Database\Factories;

use App\Models\RecommendedSource;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date,
            'telephone' => $this->faker->phoneNumber,
            'next_of_kin' => $this->faker->name,
            'passport_photograph' => 'default.jpg', // You may want to handle this differently
            'any_illness' => $this->faker->word,
            'last_residence_address' => $this->faker->address,
            'recommended_source_id' => RecommendedSource::factory(),
        ];
    }
}
