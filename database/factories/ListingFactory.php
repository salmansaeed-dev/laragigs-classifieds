<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'title' => $this->faker->sentence(10),
        'tags' => 'Laravel, API, Backend, Web',
        'company' => $this->faker->company(),
        'description' => $this->faker->paragraphs(3, true),
        'email' => $this->faker->safeEmail(),
        'website' => $this->faker->domainName(),
        'location' => $this->faker->address(),
        ];
    }
}
