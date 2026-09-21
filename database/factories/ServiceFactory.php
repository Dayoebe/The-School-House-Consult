<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    public function definition(): array
    {
        return ['title' => fake()->sentence(3), 'slug' => fake()->unique()->slug(), 'description' => fake()->sentence(), 'introduction' => fake()->paragraph(), 'activities' => ['Review priorities'], 'audience' => 'Educators', 'is_active' => true];
    }
}
