<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Promocode;
use App\Models\Variant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\MessageFormatter;
use Maib\MaibApi\MaibClient;
use function PHPUnit\Framework\equalToCanonicalizing;

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

        $options = [
            'base_uri' => MaibClient::MAIB_TEST_BASE_URI,
            'debug'  => false,
            'verify' => true,
            'cert'    => [MaibClient::MAIB_TEST_CERT_URL, MaibClient::MAIB_TEST_CERT_PASS],
            'ssl_key' => MaibClient::MAIB_TEST_CERT_KEY_URL,
            'config'  => [
                'curl'  =>  [
                    CURLOPT_SSL_VERIFYHOST => 2,
                    CURLOPT_SSL_VERIFYPEER => true,
                ]
            ]
        ];

        if (isset($stack)) {
            $options['handler'] = $stack;
        }

        $guzzleClient = new Client($options);
        $client = new MaibClient($guzzleClient);

        // The Parameters required to use MaibClient methods
        $amount = $order->total_price; // The amount of the transaction
        $currency = 498; // The currency of the transaction - is the 3 digits code of currency from ISO 4217
        $clientIpAddr = \request()->ip();
        $description = 'Aurum.MD'; // The description of the transaction
        $lang = 'ru'; // The language for the payment gateway

        // Other parameters
        $sms_transaction_id = null;
        $dms_transaction_id = null;
        $redirect_url = MaibClient::MAIB_TEST_REDIRECT_URL . '?trans_id=';
        $sms_redirect_url = '';
        $dms_redirect_url = '';

        // The register dms authorization method
        $registerDmsAuthorization = $client->registerDmsAuthorization($amount, $currency, $clientIpAddr, $description, $lang);
        $trans = $registerDmsAuthorization['TRANSACTION_ID'];
        $dms_transaction_id = $registerDmsAuthorization["TRANSACTION_ID"];
        $dms_redirect_url = $redirect_url . $dms_transaction_id;

        $payment = Payment::create([
            'transaction_id' => $dms_transaction_id,
            'order_id' => $order->id,
            'amount' => $amount,
            'ip' => \request()->ip(),
            'agent' => \request()->header('User-Agent'),
        ]);
//        dd($payment);


        // Log the payment
        Log::info('Payment for order ' . $order->id . ' initialized. Total price ' . $order->total_price . ' MDL');

        return Redirect::to($dms_redirect_url);
    }

    public function paymentCallback(Request $request)
    {
        if (Payment::where('transaction_id', $request->get('trans_id'))->exists()) {
            $payment = Payment::where('transaction_id', $request->get('trans_id'))->first();

            $options = [
                'base_uri' => MaibClient::MAIB_TEST_BASE_URI,
                'debug' => false,
                'verify' => true,
                'cert' => [MaibClient::MAIB_TEST_CERT_URL, MaibClient::MAIB_TEST_CERT_PASS],
                'ssl_key' => MaibClient::MAIB_TEST_CERT_KEY_URL,
                'config' => [
                    'curl' => [
                        CURLOPT_SSL_VERIFYHOST => 2,
                        CURLOPT_SSL_VERIFYPEER => true,
                    ]
                ]
            ];

            if (isset($stack)) {
                $options['handler'] = $stack;
            }

            $guzzleClient = new Client($options);
            $client = new MaibClient($guzzleClient);
            $getTransactionResult = $client->getTransactionResult($payment->transaction_id, $payment->ip);


            switch ($getTransactionResult["RESULT"]) {
                case "CREATED":
                    Log::info('Payment for order ' . $payment->order_id . ' created. Total price ' . $payment->amount . ' MDL');
                    break;
                case "OK":
                    $order = Order::find($payment->order_id);
                    $order->is_paid = true;
                    $order->status = Order::STATUS_NEW;
                    $order->save();
                    Log::info('Payment for order ' . $payment->order_id . ' approved. Total price ' . $payment->amount . ' MDL');
                    break;
                case "PENDING":
                    Log::info('Payment for order ' . $payment->order_id . ' is pending. Total price ' . $payment->amount . ' MDL');
                    break;
                case "DECLINED":
                    Log::info('Payment for order ' . $payment->order_id . ' declined. Total price ' . $payment->amount . ' MDL');
                    break;
                case "REVERSED":
                    Log::info('Payment for order ' . $payment->order_id . ' reversed. Total price ' . $payment->amount . ' MDL');
                    break;
                case "AUTOREVERSED":
                    Log::info('Payment for order ' . $payment->order_id . ' autoreversed. Total price ' . $payment->amount . ' MDL');
                    break;
                case "TIMEOUT":
                    Log::info('Payment for order ' . $payment->order_id . ' timed out. Total price ' . $payment->amount . ' MDL');
                    break;
            }

            $payment->result = $getTransactionResult['RESULT'];
            $payment->result_code = $getTransactionResult['RESULT_CODE'] ?? null;
            $payment->rrn = $getTransactionResult['RRN'] ?? null;
            $payment->approval_code = $getTransactionResult['APPROVAL_CODE'] ?? null;
            $payment->card_number = $getTransactionResult['CARD_NUMBER'] ?? null;
            $payment->all = $request->all();
            $payment->save();
        }

        return Redirect::to('https://aurum.md/account/orders');
    }

    // confirm order
    public function confirm(Order $order)
    {
        // Update stock and status
        foreach ($order->items as $item) {
            $variant = Variant::find($item->variation_id);
            $order->status = Order::STATUS_NEW;

            // check if variant is available
            if ($variant->stock < $item->quantity) {
                Log::alert('Order ' . $order->id . ' has been canceled because of not enough stock for variant ' . $variant->id);
                $order->status = Order::STATUS_ON_HOLD;
                $order->save();
            } else {
                $variant->stock -= $item->quantity;
                $variant->save();
            }
        }

        $order->is_paid = true;
        $order->save();
        return true;
    }
}
