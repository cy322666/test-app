<?php

use App\Services\Products;

use Illuminate\Http\Request;

abstract class FilterFactory
{
    public static function getFilter(Request $request) : FilterInterface
    {
        return match ($request->input('filter')) {
            'name'          => new FilterName(),
            'category_id'   => new FilterCategoryId(),
            'category_name' => new FilterCategoryName(),
            'price'     => new FilterPrice(),
            'publish'   => new FilterPublish(),
            'deleted'   => new FilterDeleted(),
            default     => new FilterDefault(),
        };
    }
}
