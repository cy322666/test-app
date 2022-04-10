<?php

namespace App\Filters\Products;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Exceptions\HttpResponseException;

class FilterCategoryName extends FilterAbstract implements FilterInterface
{
    private string $category_name;
    private Builder $categories;

    public function search(): Builder
    {
        $this->initParams();

        return $this->categories;
    }

    protected function initParams()
    {
        $this->category_name = $this->request->input('category_name');

        $this->validateParams();

        $this->categories = Product::query()
            ->whereHas('categories', function (Builder $query) {

                $query->where('name', 'like', "%{$this->category_name}%");

        });
    }

    protected function validateParams()
    {
        if(strlen($this->category_name) < 3) {

            throw new HttpResponseException(
                response()->json('Category name invalid', 422)
            );
        }
    }
}
