<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\CategoryTranslation;
use App\Models\Language;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\ProductVariant;
use App\Models\ProductVariation;

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
     * @param StoreProductRequest $request
     * @return mixed
     */
    public function store(StoreProductRequest $request): array
    {
        $product = Product::create($request->validated());

        foreach (Language::all() as $language) {
            ProductTranslation::create([
                'product_id' => (int)$product->id,
                'locale' => (string)$language->code,
                'name' => (string)$request->get('name_'.$language->code),
                'description' => (string)$request->get('description_' .$language->code),
                'meta_title' => (string)$request->get('meta_title_' .$language->code) ?? $request->get('name_'.$language->code),
                'meta_description' => (string)$request->get('meta_description_' .$language->code) ?? '',
                'out_of_stock_text' => (string)$request->get('out_of_stock_text_' .$language->code) ?? '',
            ]);
        }

        $variants = json_decode($request->input('variations'));
        foreach ($variants as $variant) {
            //check if exist variant with this sku
            if (!ProductVariation::where('sku', $variant->sku)->exists())
            {
                $variation = ProductVariation::create([
                    'product_id' => $product->id,
                    'sku' => (int)$variant->sku,
                    'price' => (float)$variant->price,
                    'stock' => (int)$variant->stock,
                ]);

                foreach ($variant->options as $option) {
                    ProductVariant::create([
                        'product_variation_id' => $variation->id,
                        'option_id' => $option,
                    ]);
                }
            }

        }

        if (!count($product->compactMode()['variations'])) {
            $product->delete();
            return ['message' => 'Product has no variations and was deleted'];
        }

        return $product->compactMode();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product->compactMode();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
