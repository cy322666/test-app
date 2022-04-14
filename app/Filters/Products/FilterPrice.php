<?php

namespace App\Filters\Products;


use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Http\FormRequest;

class FilterPrice implements FilterInterface
{
    public function searchByRequest(FormRequest $request): Builder|Relation
    {
        return Product::query()
            ->whereBetween('price', [
                $request->price_at,
                $request->price_to
            ]);
    }
}
