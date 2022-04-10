<?php

namespace App\Filters\Products;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class FilterPublish extends FilterAbstract implements FilterInterface
{
    private bool $is_publish;

    public function search(): Builder
    {
        $this->initParams();

        return Product::query()->where('is_publish', $this->is_publish);
    }

    protected function initParams()
    {
        $this->is_publish = $this->request->input('is_publish') === '1';
    }
}
