<?php

namespace App\Filters\Products;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class FilterDeleted extends FilterAbstract implements FilterInterface
{
    private bool $is_deleted;

    public function search(): Builder
    {
        $this->initParams();

        return Product::query()->where('is_deleted', $this->is_deleted);
    }

    protected function initParams()
    {
        $this->is_deleted = $this->request->input('is_deleted') === '1';
    }
}
