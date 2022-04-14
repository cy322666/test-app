<?php

namespace App\Filters\Products;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Http\FormRequest;

class FilterDeleted implements FilterInterface
{
    public function searchByRequest(FormRequest $request): Builder|Relation
    {
        return $request->is_deleted === '1' ?  Product::onlyTrashed() : Product::query();
    }
}
