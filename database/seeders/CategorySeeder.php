<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Star Wars',
            'City',
            'Technic',
            'Ninjago',
            'Marvel'
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => str($name)->slug()
            ]);
        }
    }
}
