<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'category_id' => Category::query()->inRandomOrder()->value('id') ?? Category::factory(),
            'name'        => $this->faker->words(3, true),
            'price'       => $this->faker->randomFloat(2, 29.90, 999.90),
            'description' => $this->faker->paragraph(),
            'specs'       => $this->faker->randomElements([
                'Peças inclusas',
                'Montagem rápida',
                'Modelo colecionável',
                'Inclui mini figuras',
                'Compatível com Lego clássico'
            ], rand(1, 4)),
            'image_path'  => 'default.jpg',
        ];
    }
}
