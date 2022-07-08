<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class CategoryController extends Controller
{
    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return Category::all();
    }

    /**
     * @param StoreCategoryRequest $request
     * @return Category
     */
    public function store(StoreCategoryRequest $request): Category
    {
        return Category::create($request->all());
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return Category
     */
    public function update(UpdateCategoryRequest $request, Category $category): Category
    {
        $category->update($request->all());
        return $category;
    }

    /**
     * @param Category $category
     * @return bool
     */
    public function destroy(Category $category):bool
    {
        return $category->delete() ? true : false;
    }
}
