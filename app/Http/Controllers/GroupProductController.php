<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupProductRequest;
use App\Http\Requests\UpdateGroupProductRequest;
use App\Models\GroupProduct;

class GroupProductController extends Controller
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
     * @param  \App\Http\Requests\StoreGroupProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupProduct  $groupProduct
     * @return \Illuminate\Http\Response
     */
    public function show(GroupProduct $groupProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupProduct  $groupProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupProduct $groupProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGroupProductRequest  $request
     * @param  \App\Models\GroupProduct  $groupProduct
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupProductRequest $request, GroupProduct $groupProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupProduct  $groupProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupProduct $groupProduct)
    {
        //
    }
}
