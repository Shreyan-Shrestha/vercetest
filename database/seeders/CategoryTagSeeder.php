<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;

class CategoryTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Initial Categories
        $categories = [
            'Architecture',
            'Engineering',
            'Urban Design',
            'Construction',
            'Civil Engineering',
            'Health',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name)]
            );
        }

        // Initial Tags
        $tags = [
            'architecture',
            'design',
            'news',
            'engineering',
            'construction',
            'health',
        ];

        foreach ($tags as $name) {
            Tag::firstOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name)]
            );
        }
    }
}