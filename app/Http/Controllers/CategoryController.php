<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Laravel\Sanctum\Guard;

class CategoryController extends Controller
{
    /**
     * @return Collection
     */
    public function index(): Collection
    {
        $categories = Category::all();
//
        foreach ($categories as $category) {
            $category->setAttribute('info', $category->getTranslated());
        }

        return $categories;
    }

    /**
     * @param StoreCategoryRequest $request
     * @return Category
     */
    public function store(StoreCategoryRequest $request): CategoryTranslation
    {
        $category = Category::create($request->validated());

        foreach (Language::all() as $language) {
            CategoryTranslation::create([
                'category_id' => $category->id,
                'locale' => $language->code,
                'name' => $request->get('name_'.$language->code),
                'slug' => CategoryController::generateSlug($request->get('name_'.$language->code), $language),
                'description' => $request->get('description_' .$language->code),
                'meta_title' => $request->get('meta_title_' .$language->code),
                'meta_description' => $request->get('meta_description_' .$language->code),
            ]);
        }

        return $category->setAttribute('info', $category->getTranslated());
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
    public function destroy(DeleteCategoryRequest $request, int $category_id): bool
    {
        return Category::find($category_id)->delete() ?? false;
    }

    /**
     * @param string $title
     * @param int $id
     * @param Language $lang
     * @return string
     */
    static public function generateSlug(string $title, Language $lang): string
    {
        $slug = Str::slug($title, '-', $lang->code);
        if (CategoryTranslation::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . rand(1, 100);
        }

        return $slug;
    }
}
