<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Will generate a number from 1 - 10. For now, we will generate 10 newsletters when seeding.
            'NewsletterID' => $this->faker->numberBetween(1, 10),

            // Using a random company for the Title column
            'Title' => $this->faker->company(),
            'Description' => $this->faker->text(256),
            'Image' => $this->faker->imageUrl()
        ];
    }
}
