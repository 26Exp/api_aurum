<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Image;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Variation;
use Composer\Config;
use http\Client\Response;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $default = [
            'page' => 1,
            'per_page' => 20,
            'sort_by' => 'id',
            'sort_direction' => 'desc',
        ];
        $params = array_merge($default, request()->all());

        $products = Product::with('images')
            ->orderBy($params['sort_by'], $params['sort_direction'])
            ->paginate($params['per_page']);
        $products->appends($params);

        foreach ($products as $product) {
            $product->stock = $product->variants()->sum('stock');
            if ($product->min_price == $product->max_price) {
                (int)$product->price = $product->min_price;
            } else {
                (int)$product->price = $product->min_price . ' - ' . $product->max_price;
            }
        }

        return response()->json($products);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(): JsonResponse
    {
        $default = [
            'page' => 1,
            'per_page' => 20,
            'sort_by' => 'id',
            'sort_direction' => 'desc',
            'q' => '',
            'category_id' => '',
            'min_price' => 0,
            'max_price' => 999999999,
        ];
        $params = array_merge($default, request()->all());
        $params['min_price'] = (int) $params['min_price'];
        $params['max_price'] = (int) $params['max_price'];

        $products = Product::with('images')
            ->where(function ($query) use ($params) {
                if ($params['q']) {
                    $query->where('name_ru', 'like', '%'.$params['q'].'%')
                        ->orWhere('name_ro', 'like', '%'.$params['q'].'%');
                }
            })
            ->where(function ($query) use ($params) {
                if ($params['category_id']) {
                    $query->where('category_id', $params['category_id']);
                }
            })
            ->where(function ($query) use ($params) {
                if ($params['min_price']) {
                    $query->where('min_price', '>=', (int)$params['min_price']);
                }
                if ($params['max_price']) {
                    $query->where('max_price', '<=', (int)$params['max_price']);
                }
            })
            ->orderBy($params['sort_by'], $params['sort_direction'])
            ->paginate($params['per_page'])
            ->appends($params);
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProductRequest $request)
    {
        if (count($request->variants)) {
            $product = Product::create($request->validated());
            $product->attachImages($request->images ?? []);
            $product->attachVariants($request->variants);

            return response()->json([
                'message' => 'Product created successfully',
                'product' => $product,
            ], 201);
        } else {

            return response()->json([
                'message' => 'Variansts are required',
            ], 422);
        }
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
        $product->attachImages($request->images ?? []);

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

    public function allProducts($lang = 'ru')
    {
        $default = [
            'page' => 1,
            'per_page' => 20,
            'sort_by' => 'id',
            'sort_direction' => 'desc',
        ];
        $params = array_merge($default, request()->all());
        $products = Product::where('status', Product::STATUS_PUBLISHED)
            ->orderBy($params['sort_by'], $params['sort_direction'])
            ->paginate($params['per_page'])
            ->appends($params);
        return response()->json($products);
//        return response()->json($products->map(function ($product) use ($lang) {
//            $minPrice = $product->variants->min('price');
//            $maxPrice = $product->variants->max('price');
//            return [
//                'id' => $product->id,
//                'name' => $product->{"name_$lang"},
//                'slug' => env('APP_URL'). "/product/" .$product->{'slug_' . $lang},
//                'min_price' => $minPrice,
//                'max_price' => $maxPrice,
//                'images' => $product->attachImages($product),
//            ];
//        }));
    }

    /**
     * @param $lang
     * @param $slug
     * @return JsonResponse
     */
    public function productByLocaleAndSlug($lang, $slug): JsonResponse
    {

        $product = Product::where('slug_' . $lang, $slug)->first();
        if ($product) {
            $product->increment('views');
            return response()->json($product->getByLang($lang));
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    public function getUpsell($lang = 'ru', Product $product)
    {
        $upsell = $product->upsell();
        return response()->json($upsell->map(function (Product $product) use ($lang) {
            $minPrice = $product->variants->min('price');
            $maxPrice = $product->variants->max('price');
            return [
                'id' => $product->id,
                'name' => $product->{"name_$lang"},
                'slug' => env('APP_URL'). "/product/" .$product->{'slug_' . $lang},
                'min_price' => $minPrice,
                'max_price' => $maxPrice,
                'images' => $product->getUploadedImagesAttribute(),
            ];
        }));
    }
}
