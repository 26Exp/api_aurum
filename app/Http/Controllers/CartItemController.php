<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartItemRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Models\CartItem;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $cartItems = CartItem::with(['product'])->where('user_id', auth()->id())->get();
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->quantity * $cartItem->variant->price;
        });

        return response()->json([
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
        ]);
    }

    /**
     * @param StoreCartItemRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCartItemRequest $request)
    {
        $cartItem = CartItem::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->where('variant_id', $request->variant_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $cartItem = CartItem::create($request->all());
        }

        return response()->json($cartItem);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCartItemRequest  $request
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCartItemRequest $request, CartItem $cartItem)
    {
        $cartItem->update($request->all());
        return response()->json($cartItem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CartItem $cartItem)
    {
        // find and delete cart item if exists
        $cartItem = CartItem::where('user_id', auth()->id())
            ->where('id', request()->route('cart'))
            ->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return response()->json(['message' => 'Cart item deleted']);
    }
}
