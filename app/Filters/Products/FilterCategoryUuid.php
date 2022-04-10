<?php

namespace App\Filters\Products;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Exceptions\HttpResponseException;

class FilterCategoryUuid extends FilterAbstract implements FilterInterface
{
    private string $category_uuid;

    public function search(): Builder|BelongsToMany
    {
        $this->initParams();

        $category = Category::query()
            ->where('uuid', $this->category_uuid)
            ->first();

        return $category->products();
    }

    protected function initParams()
    {
        $this->category_uuid = $this->request->input('category_uuid');

        if(strlen($this->category_uuid) < 3) {

            throw new HttpResponseException(
                response()->json('Category not exists', 422)
            );
        }
    }
}
