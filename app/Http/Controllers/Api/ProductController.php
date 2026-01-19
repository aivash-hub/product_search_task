<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return Product::query()
            ->filter($request->all())
            ->paginate(min((int) $request->get('per_page', 10), 100));
    }
}
