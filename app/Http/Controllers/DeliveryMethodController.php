<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeliveryMethodRequest;
use App\Http\Requests\UpdateDeliveryMethodRequest;
use App\Models\DeliveryMethod;

class DeliveryMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DeliveryMethod::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDeliveryMethodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeliveryMethodRequest $request)
    {
        $deliveryMethod = DeliveryMethod::create($request->validated());
        return $deliveryMethod;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeliveryMethod  $deliveryMethod
     * @return DeliveryMethod
     */
    public function show(DeliveryMethod $deliveryMethod)
    {
        return $deliveryMethod;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDeliveryMethodRequest  $request
     * @param  \App\Models\DeliveryMethod  $deliveryMethod
     * @return DeliveryMethod
     */
    public function update(UpdateDeliveryMethodRequest $request, DeliveryMethod $deliveryMethod)
    {
        $deliveryMethod->update($request->validated());
        return $deliveryMethod;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryMethod  $deliveryMethod
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeliveryMethod $deliveryMethod)
    {
        $deliveryMethod->delete();
        return response()->json(null, 204);
    }
}
