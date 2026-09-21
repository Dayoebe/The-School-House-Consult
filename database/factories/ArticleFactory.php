<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        return ['title' => fake()->sentence(3), 'slug' => fake()->unique()->slug(), 'excerpt' => fake()->sentence(), 'body' => fake()->paragraph(), 'status' => 'draft', 'published_at' => null];
    }
}
