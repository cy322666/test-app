<?php

namespace App\Filters\Products;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FilterCategoryName implements FilterInterface
{
    public function searchByRequest(FormRequest $request): Builder|Relation
    {
        return Product::query()
            ->whereHas('categories', function (Builder $query) use ($request) {

                $query->where('name', 'like', "%{$request->category_name}%");
            });
    }
}
