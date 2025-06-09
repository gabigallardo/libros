<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(5),
            'author_name' => $this->faker->name(),
            'content' => $this->faker->paragraphs(3, true),
            'category_id' => Category::inRandomOrder()->first()->id,
            'stars' => $this->faker->numberBetween(1, 5),
            'habilitated' => true,
        ];
    }
}
