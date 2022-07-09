<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryTranslationRequest;
use App\Http\Requests\UpdateCategoryTranslationRequest;
use App\Models\CategoryTranslation;

class CategoryTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryTranslationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryTranslationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryTranslation  $categoryTranslation
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryTranslation $categoryTranslation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryTranslation  $categoryTranslation
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryTranslation $categoryTranslation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryTranslationRequest  $request
     * @param  \App\Models\CategoryTranslation  $categoryTranslation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryTranslationRequest $request, CategoryTranslation $categoryTranslation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryTranslation  $categoryTranslation
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryTranslation $categoryTranslation)
    {
        //
    }
}
