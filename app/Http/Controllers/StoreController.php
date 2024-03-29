<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Store;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Store::paginate());
    }

    public function allStores()
    {
        return response()->json(Store::all());
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
     * @param  \App\Http\Requests\StoreStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreStoreRequest $request)
    {
        $store = Store::create($request->validated());
        return response()->json($store);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Store $store)
    {
        return response()->json($store);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStoreRequest  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        $store->update($request->validated());
        return response()->json($store);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Store $store)
    {
        $store->delete();
        return response()->json(['message' => 'Store deleted']);
    }
}
