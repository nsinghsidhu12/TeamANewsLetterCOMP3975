<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Newsletter>
 */
class NewsletterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Logo' => $this->faker->imageUrl(),

            // A random unique newsletter number will be between 1 and the value configured for NEWSLETTER_NUM_MAX
            'Number' => $this->faker->unique()->numberBetween(1, env('NEWSLETTER_NUM_MAX', 10)),
            'Date' => $this->faker->date(),
            'Title' => $this->faker->company(),
            'IsActive' => $this->faker->boolean()
        ];
    }
}
