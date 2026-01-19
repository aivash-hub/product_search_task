<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Поиск по названию
        if ($request->filled('q')) {
            $query->whereFullText('name', $request->q);
        }

        // Фильтры

        // По цене
        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        // По категории
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // По наличию на складе
        if ($request->filled('in_stock')) {
            $query->where('in_stock', filter_var($request->in_stock, FILTER_VALIDATE_BOOLEAN));
        }

        // По рейтингу
        if ($request->filled('rating_from')) {
            $query->where('rating', '>=', $request->rating_from);
        }

        // Сортировка
        match ($request->get('sort')) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'rating_desc' => $query->orderBy('rating', 'desc'),
            'newest' => $query->orderBy('created_at', 'desc'),
            default => $query->orderBy('id')
        };

        // Пагинация
        $perPage =  min((int) $request->get('per_page', 10), 100);

        return $query->paginate($perPage);
    }
}
