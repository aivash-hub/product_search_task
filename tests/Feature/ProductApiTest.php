<?php

namespace Tests\Feature;

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
}
