<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement([
            'Star Wars',
            'City',
            'Technic',
            'Ninjago',
            'Marvel'
        ]);

        return [
            'name' => $name,
            'slug' => str($name)->slug()
        ];
    }
}
