<?php

namespace App\Filters\Products;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Http\FormRequest;

class FilterProductName implements FilterInterface
{
    public function searchByRequest(FormRequest $request): Builder|Relation
    {
        return Product::query()->where('name', 'LIKE', "%{$request->product_name}%");
    }
}
