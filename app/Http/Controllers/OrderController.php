<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Promocode;
use App\Models\Variant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Order::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreOrderRequest $request)
    {
        $totalPrice = 0;
        // Calculate total price and check stock availability
        foreach ($request->products as $product) {
            $variant = Variant::find($product['variant_id']);
            if ($variant->stock < $product['quantity']) {
                return response()->json([
                    'message' => 'Недостаточно товара в наличии',
                ], 422);
            }
            $totalPrice += $variant->price * $product['quantity'];
        }

        // Add free delivery if total price is more than 1000
        if ($totalPrice < 1000 && $request->validated('delivery_method_id') == DeliveryMethod::SHIPPING) {
            $deliveryPrice = DeliveryMethod::find($request->validated('delivery_method_id'))->price;
            $totalPrice += $deliveryPrice;
        }

        // Check promocode
        if ($request->validated('promocode_id')) {
            $promocode = Promocode::find($request->validated('promocode_id'));

            if ($promocode->active && $promocode->expires_at >= now()) {

                // Check promocode uses limit
                if ($promocode->max_uses != 0 && $promocode->uses >= $promocode->max_uses) {
                    return response()->json([
                        'message' => 'The promo code has been used the maximum number of times.',
                    ], 422);
                }

                // Check promocode uses limit for user
                if ((boolean)$promocode->multiple_use === false) {
                    $orders = Order::where('user_id', Auth::id())->where('promocode_id', $promocode->id)->get();
                    if ($orders->count() > 0) {
                        return response()->json([
                            'message' => 'The promo code has been already used.',
                        ], 422);
                    }
                }

                // Calculate discount for percent or amount
                if ($promocode->is_percentage) {
                    $discount = $totalPrice * $promocode->discount / 100;
                } else {
                    $discount = $promocode->discount;
                }

                $totalPrice -= $discount;
                $promocode->uses++;
                $promocode->save();
                Log::info('Promocode ' . $promocode->code . ' was used by user ' . Auth::user()->id . ' discount ' . $discount . ' MDL. Total price ' . $totalPrice .' MDL');

            } else {
                return response()->json([
                    'message' => 'Promocode is invalid',
                ], 422);
            }
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'address_id' => $request->address_id,
            'payment_method_id' => Auth::user()->isAdmin()
                ? PaymentMethod::CASH
                : $request->validated('payment_method_id'),
            'delivery_method_id' => $request->delivery_method_id,
            'promocode_id' => $request->promocode_id,
            'total_price' => $totalPrice,
            'status' => Auth::user()->isAdmin()
                ? Order::STATUS_NEW
                : Order::STATUS_PENDING,
            'is_paid' => false,
            'free_delivery' => $totalPrice >= 1000,
            'is_created_by_admin' => Auth::user()->isAdmin(),
        ]);

        if ($order->payment_method_id == PaymentMethod::CASH) {
            $order->is_paid = true;
            $order->save();
        }

        if ($order->payment_method_id == PaymentMethod::CARD) {
            return response()->json([
                'redirect' => route('order.pay', $order->id),
            ], 201);
        }

        foreach ($request->products as $product) {
            $order->items()->create([
                'product_id' => $product['id'],
                'variation_id' => $product['variant_id'],
                'quantity' => $product['quantity'],
                'price' => Variant::find($product['variant_id'])->price,
                'total' => Variant::find($product['variant_id'])->price * $product['quantity'],
            ]);
        }

        return response()->json([
            'message' => 'Order created',
            'order' => $order,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Order $order)
    {
        // Add order items to order
        $order->items;
        $order->address;
        $order->paymentMethod;
        $order->deliveryMethod;
        $order->promocode;
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $this->authorize('update', $order);
        $order->update($request->validated());
        return response()->json([
            'message' => 'Order updated',
            'order' => $order,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Order $order)
    {
        $this->authorize('delete', $order);
        $order->delete();
        return response()->json([
            'message' => 'Order deleted',
        ], 200);

    }

    public function pay(Order $order)
    {
       //  show server ip address and other info
        $ip = $_SERVER['REMOTE_ADDR'];
        return $order;
    }

    public function paymentCallback(Request $request)
    {
        // Save in log file
        Log::info('Payment callback: ' . json_encode($request->all()));
        echo 'MAIB callback';
    }
}
