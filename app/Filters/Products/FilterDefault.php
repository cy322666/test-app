<?php

namespace App\Filters\Products;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class FilterDefault extends FilterAbstract implements FilterInterface
{
    public function search(): Builder
    {
        return Product::query();
    }
}
