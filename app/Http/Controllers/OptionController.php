<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use App\Models\Category;
use App\Models\Language;
use App\Models\Option;
use App\Models\OptionTranslation;
use Illuminate\Support\Collection;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Option::all();
    }

    /**
     * @param StoreOptionRequest $request
     * @return Option
     */
    public function store(StoreOptionRequest $request): Option
    {
        $option = Option::create($request->validated());
        foreach (Language::all() as $language) {
            OptionTranslation::create([
                'option_id' => $option->id,
                'locale' => $language->code,
                'name' => $request->get('name_'.$language->code),
            ]);
        }

        return Option::find($option->id);
    }

    public function show(Option $option)
    {
        return $option;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOptionRequest  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOptionRequest $request, Option $option)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Option $option)
    {
        Option::destroy($option->id);

        return response()->json(['message' => 'Deleted']);
    }

    /**
     * Return all options for a category.
     * @param int $category_id
     * @return Collection
     */
    public function byCategory(int $category_id): Collection
    {
        return Option::where('category_id', $category_id)->get();
    }
}
