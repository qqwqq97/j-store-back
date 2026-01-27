<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent; 
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        Log::debug($request->all());
        Stripe::setApiKey(env('VITE_STRIPE_SECRET_KEY'));

        try {
            // Stripe 결제 생성
            // PaymentIntent : 결제를 준비하고 처리하는 객체
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount,
                'currency' => 'jpy',
                'payment_method' => $request->payment_method,
                'confirm' => true, // 결제를 바로 승인할지 true면 바로 결제 진행 false면 결제를 만들기만 하고 나중에 confirm 따로 해야함 
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never',   // 🔥 중요
                ],
            ]);

            $user = Auth::user(); 

            $status = $paymentIntent->status === 'succeeded' ? 'paid' : 'pending';

            $order = Order::create([
                'user_id' => $user->id,
                'shipping_zip' => $request->input('address.shipping_zip'),
                'shipping_address1' => $request->input('address.shipping_address1'),
                'shipping_address2' => $request->input('address.shipping_address2'),
                'shipping_phone' => $request->input('address.shipping_phone'),
                'total_amount' => $request->amount,
                'payment_intent_id' => $paymentIntent->id,
                'status' => $status,
            ]);

            foreach($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            return response()->json([
                'status' => 'success',
                'order_id' => $order->id,
                'paymentIntent' => $paymentIntent
            ]);

        } catch (\Exception $e) {
            Log::error('Stripe Error: ' . $e->getMessage());
            Log::error('Stripe Error Trace: ' . $e->getTraceAsString());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
