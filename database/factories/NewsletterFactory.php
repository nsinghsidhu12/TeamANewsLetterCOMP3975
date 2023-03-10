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
            'Date' => $this->faker->date(),
            'Title' => $this->faker->company(),
            'IsActive' => $this->faker->boolean()
        ];
    }
}
