<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Filters\Products\FilterFactory;

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
        $product->is_deleted = true;
        $product->is_published = false;
        $product->save();
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

    public function list(Request $request): ProductCollection
    {
        $filter = FilterFactory::getFilter($request);

        return new ProductCollection(
            $filter
                ->setRequest($request)
                ->search()
                ->orderBy('created_at')
                ->paginate()
        );
    }
}
