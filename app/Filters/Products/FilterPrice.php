<?php

namespace App\Filters\Products;


use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Exceptions\HttpResponseException;

class FilterPrice extends FilterAbstract implements FilterInterface
{
    private float $price_at;
    private float $price_to;

    private Builder $products;

    public function search(): Builder
    {
        $this->initParams();

        return $this->products;
    }

    protected function initParams()
    {
        $this->price_at = $this->request->input('price_at');
        $this->price_to = $this->request->input('price_to');

        $this->validateParams();

        $this->products = Product::query()
            ->whereBetween('price', [
                $this->price_at,
                $this->price_to
            ]);
    }

    protected function validateParams()
    {
        if (($this->price_at > 0 && $this->price_to > 0) == false) {

            throw new HttpResponseException(
                response()->json('Price values invalid', 422)
            );
        }
    }
}
