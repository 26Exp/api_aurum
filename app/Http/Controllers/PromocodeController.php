<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromocodeRequest;
use App\Http\Requests\UpdatePromocodeRequest;
use App\Models\Promocode;

class PromocodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Promocode::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StorePromocodeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePromocodeRequest $request)
    {
        $promocode = Promocode::create($request->validated());
        return response()->json($promocode, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Promocode $promocode
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Promocode $promocode)
    {
        return response()->json($promocode);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Promocode $promocode
     * @return \Illuminate\Http\Response
     */
    public function edit(Promocode $promocode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdatePromocodeRequest $request
     * @param \App\Models\Promocode $promocode
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePromocodeRequest $request, Promocode $promocode)
    {
        $promocode->update($request->validated());
        return response()->json($promocode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Promocode $promocode
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Promocode $promocode)
    {
        $promocode->delete();
        return response()->json(null, 204);
    }


    public function checkPromocode($code)
    {
        $promocode = Promocode::where('code', $code)->first();
        if ($promocode) {
            if ($promocode->active) {
                if ($promocode->max_uses == 0 || $promocode->uses < $promocode->max_uses) {
                    if ($promocode->expires_at == null || $promocode->expires_at > now()) {
                        return response()->json(['discount' => $promocode->discount]);
                    }
                }
            }
        }

        return response()->json(['error' => 'Promocode not found'], 404);
    }
}
