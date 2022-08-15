<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Image;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        if (count($request->variants)) {
//            $product = Product::create($request->validated());

            foreach ($request->variants as $variant) {
                dd($variant);
                $variant['product_id'] = $product->id;
                $product->variants()->create($variant);
            }

        } else {
            $product = Product::create($request->validated());
        }

        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return Product
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return Product
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        $images = Image::with('product')->where('product_id', $product->id)->get();
        foreach ($images as $image) {
            if (!in_array($image->id, $request->images)) {
                $image->delete();
            }
        }

        // delete old variants
        $product->variants()->delete();
        // create new variants
        foreach ($request->get('variants') as $variant) {
            $variant['product_id'] = $product->id;
            $product->variants()->create($variant);
        }

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }

    public function sync()
    {
//        $xmlString = file_get_contents(storage_path('app/1C/import.xml'));
        $xmlString = file_get_contents(storage_path('app/1C/offers.xml'));
        $xmlObject = simplexml_load_string($xmlString);

        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true);
        $synced = 0;

        foreach ($phpArray["ПакетПредложений"]["Предложения"]["Предложение"] as $item) {

            // Check if exist product with this sku
            if (Product::where('sku', $item["Артикул"])->exists()) {
                $product = Product::where('sku', (int)$item['Артикул'])->first();
                $product->stock = (int)$item['Количество'];
                $product->price = (int)$item['Цены']['Цена']['ЦенаЗаЕдиницу'];
                $product->save();
                $synced++;
            }
        }

        return response()->json(['message' => $synced . ' products synced.']);
    }

    public function getStatuses()
    {
        return response()->json(['statuses' => Product::STATUSES]);
    }
}
