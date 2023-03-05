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
            // Will generate a random number from 1 to the value configured for NEWSLETTER_NUM_MAX
            'NewsletterID' => $this->faker->numberBetween(1, env('NEWSLETTER_NUM_MAX', 10)),

            // Using a random company for the Title column
            'Title' => $this->faker->company(),
            'Description' => $this->faker->text(1024),
            'Image' => $this->faker->randomElement([$this->faker->imageUrl(), "None"]),
            'ImagePlacement' => $this->faker->randomElement(['Left', 'Right'])
        ];
    }
}
