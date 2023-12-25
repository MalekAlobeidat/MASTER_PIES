<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artisan>
 */
class ArtisanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $whatsappNumber = $this->faker->numerify('+1##########');
        return [
            'phone_number' => $this->faker->phoneNumber(),
            'years_of_experience' => $this->faker->numberBetween(0, 20),
            'jerny' => $this->faker->sentence,
            'formal_education' => $this->faker->sentence,
            'apprenticeships' => $this->faker->sentence,
            'association_memberships' => $this->faker->sentence,
            // Add other fields as needed
        ];
    }
}
