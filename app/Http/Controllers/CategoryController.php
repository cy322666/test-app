<?php

namespace App\Http\Controllers;

use App\Exceptions\DeleteCategoryException;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create(CreateCategoryRequest $request): CategoryResource
    {
        $category = Category::query()->create($request->validated());

        return new CategoryResource($category);
    }

    /**
     * @throws DeleteCategoryException
     */
    public function delete(Category $category)
    {
        if ($category->products->count() == 0) {

            $category->delete();
        } else
            throw new DeleteCategoryException(Category::DELETED_USE_MESSAGE);
    }

    public function update(UpdateCategoryRequest $request, Category $category): CategoryResource
    {
        $category->fill($request->validated());
        $category->save();

        return new CategoryResource($category->refresh());
    }

    /**
     * @param Category $category
     * @return CategoryResource
     */
    public function get(Category $category): CategoryResource
    {
        return new CategoryResource($category);
    }

    public function list(): CategoryCollection
    {
        return new CategoryCollection(Category::query()->paginate());
    }
}
