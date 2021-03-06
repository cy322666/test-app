<?php

namespace App\Http\Controllers\Api;

use App\Filters\Products\FilterFactory;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\ProductFilterRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    public function create(CreateProductRequest $request): ProductResource
    {
        $product = Product::query()->create($request->validated());

        $product->attachCategories($request->safe(['categories'])['categories']);

        return new ProductResource($product->refresh());
    }

    public function delete(Product $product)
    {
        $product->delete();
    }

    public function update(UpdateProductRequest $request, Product $product): ProductResource
    {
        $product->fill($request->validated());
        $product->save();

        if(!empty($request->safe(['categories']))) {

            $product->attachCategories($request->safe(['categories'])['categories']);
        }

        return new ProductResource($product->refresh());
    }

    public function get(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    public function list(ProductFilterRequest $request): ProductCollection
    {
        $filter = FilterFactory::getFilter($request->input('filter'));

        return new ProductCollection(
            $filter
                ->searchByRequest($request)
                ->with('categories')
                ->orderBy('created_at')
                ->paginate()
        );
    }
}
