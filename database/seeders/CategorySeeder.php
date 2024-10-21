<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = collect(['Technologie', 'Politique', 'Nature', 'Livre', 'Jeux-Vidéos', 'Film']);

        $categories->each(fn($category) => Category::create([
            'name' => $category,
            'slug' => Str::slug($category),
        ]));
    }
}
