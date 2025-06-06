<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Ficción',
                'slug' => Str::slug('Ficción'),
                'description' => 'Libros de ficción y novelas.',
                'icon' => 'menu_book', // 📚
            ],
            [
                'name' => 'No ficción',
                'slug' => Str::slug('No ficción'),
                'description' => 'Libros basados en hechos reales y ensayos.',
                'icon' => 'fact_check', // 📋
            ],
            [
                'name' => 'Ciencia',
                'slug' => Str::slug('Ciencia'),
                'description' => 'Libros sobre ciencia y tecnología.',
                'icon' => 'science', // 🔬
            ],
            [
                'name' => 'Historia',
                'slug' => Str::slug('Historia'),
                'description' => 'Libros históricos y biografías.',
                'icon' => 'history_edu', // 🏛️
            ],
            [
                'name' => 'Infantil',
                'slug' => Str::slug('Infantil'),
                'description' => 'Libros para niños y jóvenes.',
                'icon' => 'child_care', // 👶
            ],
            [
                'name' => 'Romance',
                'slug' => Str::slug('Romance'),
                'description' => 'Novelas románticas y historias de amor.',
                'icon' => 'favorite', // ❤️
            ],
            [
                'name' => 'Misterio',
                'slug' => Str::slug('Misterio'),
                'description' => 'Libros de misterio, suspenso y thrillers.',
                'icon' => 'visibility_off', // 👁️‍🗨️
            ],
            [
                'name' => 'Fantasía',
                'slug' => Str::slug('Fantasía'),
                'description' => 'Libros de fantasía y mundos imaginarios.',
                'icon' => 'auto_awesome', // ✨
            ],
            [
                'name' => 'Autoayuda',
                'slug' => Str::slug('Autoayuda'),
                'description' => 'Libros de crecimiento personal y motivación.',
                'icon' => 'psychology', // 🧠
            ],
            [
                'name' => 'Poesía',
                'slug' => Str::slug('Poesía'),
                'description' => 'Colección de poemas y literatura lírica.',
                'icon' => 'create', // ✍️
            ],
        ];

        // Agregamos timestamps y valores por defecto
        $categories = array_map(function ($categories) {
            return array_merge($categories, [
                'posts_count' => 0,
                'likes' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }, $categories);

        DB::table('categories')->insert($categories);
    }
}
