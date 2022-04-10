<?php

namespace App\Filters\Products;

use App\Models\Product;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class FilterName extends FilterAbstract implements FilterInterface
{
    private string $product_name;

    public function search(): Builder|Relation
    {
        $this->initParams();

        return Product::query()
            ->where('name', 'LIKE', "%{$this->product_name}%");
    }

    protected function initParams()
    {
        $this->product_name = $this->request->input('product_name');

        $this->validateParams();
    }

    protected function validateParams()
    {
        if(strlen($this->product_name) < 3) {

            throw new ValidationException('Product name invalid');
        }
    }
}
