<?php

namespace App\Filters\Products;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FilterCategoryUuid extends FilterAbstract implements FilterInterface
{
    private string $category_uuid;
    private Model $category;

    public function search(): Builder
    {
        $this->initParams();

        return $this->category->products()->getQuery();
    }

    protected function initParams()
    {
        $this->category_uuid = $this->request->input('category_uuid');

        $this->category = Category::query()
            ->where('uuid', $this->category_uuid)
            ->firstOrFail();
    }
}
