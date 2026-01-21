<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductIndexRequest;
use App\Models\Product;
use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/products',
    operationId: 'getProducts',
    tags: ['Products'],
    summary: 'Get products list',
    parameters: [
        new OA\Parameter(
            name: 'q',
            in: 'query',
            description: 'Search by product name',
            schema: new OA\Schema(type: 'string')
        ),

        new OA\Parameter(
            name: 'price_from',
            in: 'query',
            description: 'Minimum product price',
            schema: new OA\Schema(type: 'number')
        ),

        new OA\Parameter(
            name: 'price_to',
            in: 'query',
            description: 'Maximum product price',
            schema: new OA\Schema(type: 'number')
        ),

        new OA\Parameter(
            name: 'category_id',
            in: 'query',
            description: 'Filter by category ID',
            schema: new OA\Schema(type: 'integer')
        ),

        new OA\Parameter(
            name: 'in_stock',
            in: 'query',
            description: 'Only products in stock',
            schema: new OA\Schema(type: 'boolean')
        ),

        new OA\Parameter(
            name: 'rating_from',
            in: 'query',
            description: 'Minimum product rating',
            schema: new OA\Schema(type: 'number', format: 'float')
        ),

        new OA\Parameter(
            name: 'sort',
            in: 'query',
            description: 'Sorting strategy',
            schema: new OA\Schema(
                type: 'string',
                enum: ['price_asc', 'price_desc', 'rating_desc', 'newest']
            )
        ),

        new OA\Parameter(
            name: 'page',
            in: 'query',
            description: 'Page number (pagination)',
            schema: new OA\Schema(type: 'integer', minimum: 1)
        ),

        new OA\Parameter(
            name: 'per_page',
            in: 'query',
            description: 'Number of items per page',
            schema: new OA\Schema(type: 'integer', default: 10, maximum: 100)
        ),
    ],
    responses: [
        new OA\Response(response: 200, description: 'Paginated list of products')
    ]
)]

class ProductController extends Controller
{
    public function index(ProductIndexRequest $request)
    {
        return Product::query()
            ->filter($request->validated())
            ->paginate($request->validated('per_page', 10));
    }
}
