<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductIndexRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(ProductIndexRequest $request)
    {
        return Product::query()
            ->filter($request->validated())
            ->paginate($request->validated('per_page', 10));
    }
}
