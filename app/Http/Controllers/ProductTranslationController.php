<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductTranslationRequest;
use App\Http\Requests\UpdateProductTranslationRequest;
use App\Models\ProductTranslation;

class ProductTranslationController extends Controller
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
     * @param  \App\Http\Requests\StoreProductTranslationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductTranslationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductTranslation  $productTranslation
     * @return \Illuminate\Http\Response
     */
    public function show(ProductTranslation $productTranslation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductTranslation  $productTranslation
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductTranslation $productTranslation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductTranslationRequest  $request
     * @param  \App\Models\ProductTranslation  $productTranslation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductTranslationRequest $request, ProductTranslation $productTranslation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductTranslation  $productTranslation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductTranslation $productTranslation)
    {
        //
    }
}
