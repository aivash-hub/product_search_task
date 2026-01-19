<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter
{
    public function applyFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['q'] ?? null, fn ($q, $value) =>
                $q->whereFullText('name', $value)
            )
            ->when($filters['price_from'] ?? null, fn ($q, $value) =>
                $q->where('price', '>=', $value)
            )
            ->when($filters['price_to'] ?? null, fn ($q, $value) =>
                $q->where('price', '<=', $value)
            )
            ->when($filters['category_id'] ?? null, fn ($q, $value) =>
                $q->where('category_id', $value)
            )
            ->when(array_key_exists('in_stock', $filters), fn ($q) =>
                $q->where('in_stock', $filters['in_stock'])
            )
            ->when(array_key_exists('in_stock', $filters), fn ($q) =>
                $q->where('in_stock', filter_var($filters['in_stock'], FILTER_VALIDATE_BOOLEAN))
            )
            ->when($filters['rating_from'] ?? null, fn ($q, $value) =>
                $q->where('rating', '>=', $value)
            );
    }

    public function applySorting(Builder $query, ?string $sort): Builder
    {
        return match ($sort) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'rating_desc' => $query->orderBy('rating', 'desc'),
            'newest' => $query->orderBy('created_at', 'desc'),
            default => $query->orderBy('id')
        };
    }
}
