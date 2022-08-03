<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductOptionValueRequest;
use App\Http\Requests\UpdateProductOptionValueRequest;
use App\Models\ProductOptionValue;

class ProductOptionValueController extends Controller
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
     * @param  \App\Http\Requests\StoreProductOptionValueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductOptionValueRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductOptionValue  $productOptionValue
     * @return \Illuminate\Http\Response
     */
    public function show(ProductOptionValue $productOptionValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductOptionValue  $productOptionValue
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductOptionValue $productOptionValue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductOptionValueRequest  $request
     * @param  \App\Models\ProductOptionValue  $productOptionValue
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductOptionValueRequest $request, ProductOptionValue $productOptionValue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductOptionValue  $productOptionValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductOptionValue $productOptionValue)
    {
        //
    }
}
