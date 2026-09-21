<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CaseStudyFactory extends Factory
{
    public function definition(): array
    {
        return ['title' => fake()->sentence(3), 'slug' => fake()->unique()->slug(), 'summary' => fake()->sentence(), 'challenge' => fake()->paragraph(), 'approach' => fake()->paragraph(), 'outcome' => fake()->paragraph(), 'status' => 'draft', 'published_at' => null];
    }
}
