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
            'content' => $this->faker->paragraphs(3, true),
            'category_id' => Category::inRandomOrder()->first()->id, // Asigna una categoría aleatoria
            'habilitated' => true,
        ];
    }
}
