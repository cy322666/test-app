<?php

namespace App\Filters\Products;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Http\FormRequest;

class FilterCategoryUuid implements FilterInterface
{
    public function searchByRequest(FormRequest $request): Builder|Relation
    {
        $category = Category::query()
            ->where('id', $request->category_uuid)
            ->first();

        return $category->products();
    }
}
