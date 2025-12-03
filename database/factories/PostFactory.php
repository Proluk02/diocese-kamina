<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'excerpt' => $this->faker->paragraph,
            'body' => $this->faker->text(2000),
            'status' => 'published',
            'published_at' => now(),
            'is_featured' => $this->faker->boolean(20),
        ];
    }
}