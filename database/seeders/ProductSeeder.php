<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electronics = Category::firstOrCreate(['name' => 'Electronics']);
        $books = Category::firstOrCreate(['name' => 'Books']);

        Product::insert([
            [
                'name' => 'iPhone 15',
                'price' => 999.99,
                'rating' => 4.8,
                'in_stock' => true,
                'category_id' => $electronics->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy',
                'price' => 799.00,
                'rating' => 4.5,
                'in_stock' => true,
                'category_id' => $electronics->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '1984',
                'price' => 29.99,
                'rating' => 4.6,
                'in_stock' => false,
                'category_id' => $books->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
