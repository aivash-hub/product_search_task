<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'price' => $this->faker->numberBetween(10, 2000),
            'rating' => $this->faker->randomFloat(1, 1, 5),
            'in_stock' => $this->faker->boolean,
            'category_id' => Category::factory(),
        ];
    }
}
