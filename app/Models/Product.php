<?php

namespace App\Models;

use App\Filters\ProductFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        $filter = new ProductFilter();

        $query = $filter->applyFilter($query, $filters);

        return $filter->applySorting($query, $filters['sort'] ?? null);
    }
}
