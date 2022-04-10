<?php

namespace App\Filters\Products;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Exceptions\HttpResponseException;

class FilterProductName extends FilterAbstract implements FilterInterface
{
    private string $product_name;

    public function search(): Builder|Relation
    {
        $this->initParams();

        return Product::query()->where('name', 'LIKE', "%{$this->product_name}%");
    }

    protected function initParams()
    {
        $this->product_name = $this->request->input('product_name');

        $this->validateParams();
    }

    protected function validateParams()
    {
        if(strlen($this->product_name) < 3) {

            throw new HttpResponseException(
                response()->json('Product name invalid', 422)
            );
        }
    }
}
