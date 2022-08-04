<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttributeValueRequest;
use App\Http\Requests\UpdateAttributeValueRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AttributeValue::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAttributeValueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttributeValueRequest $request)
    {
       return AttributeValue::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AttributeValue  $attributeValue
     * @return AttributeValue
     */
    public function show(AttributeValue $attributeValue)
    {
        return $attributeValue;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAttributeValueRequest  $request
     * @param  \App\Models\AttributeValue  $attributeValue
     * @return AttributeValue
     */
    public function update(UpdateAttributeValueRequest $request, AttributeValue $attributeValue)
    {
        $attributeValue->update($request->all());
        return $attributeValue;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttributeValue  $attributeValue
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(AttributeValue $attributeValue)
    {
        $attributeValue->delete();
        return response()->json(null, 204);
    }

    /**
     * @param Attribute $attribute
     * @return mixed
     */
    public function getAttributeValues(Attribute $attribute)
    {
        return $attribute->values;
    }
}
