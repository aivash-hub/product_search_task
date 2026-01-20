<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_products_endpoint_returns_list(): void
    {
        Product::factory()->count(3)->create();

        $response = $this->getJson('/api/products');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'current_page',
                'per_page',
                'total',
            ]);
    }

    public function test_can_filter_products_by_in_stock(): void
    {
        Product::factory()->create(['in_stock' => true]);
        Product::factory()->create(['in_stock' => false]);

        $response = $this->getJson('/api/products?in_stock=1');

        $response
            ->assertStatus(200)
            ->assertJsonCount(1, 'data');
    }

    public function test_invalid_rating_returns_validation_error(): void
    {
        $response = $this->getJson('/api/products?rating_from=10');

        $response
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => ['rating_from'],
            ]);
    }

    public function test_can_sort_products_by_price_desc(): void
    {
        Product::factory()->create(['price' => 100]);
        Product::factory()->create(['price' => 300]);
        Product::factory()->create(['price' => 200]);

        $response = $this->getJson('/api/products?sort=price_desc');

        $response->assertStatus(200);

        $prices = collect($response->json('data'))
            ->pluck('price')
            ->all();

        $this->assertSame([300, 200, 100], $prices);
    }

    public function test_can_change_items_per_page(): void
    {
        Product::factory()->count(15)->create();

        $response = $this->getJson('/api/products?per_page=5');

        $response
            ->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonPath('per_page', 5)
            ->assertJsonPath('total', 15);
    }

    public function test_can_filter_products_by_category(): void
    {
        $categoryA = Category::factory()->create();
        $categoryB = Category::factory()->create();

        Product::factory()->count(2)->create([
            'category_id' => $categoryA->id,
        ]);

        Product::factory()->count(1)->create([
            'category_id' => $categoryB->id,
        ]);

        $response = $this->getJson('/api/products?category_id=' . $categoryA->id);

        $response
            ->assertStatus(200)
            ->assertJsonCount(2, 'data');
    }
}
