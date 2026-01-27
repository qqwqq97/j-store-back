<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Address;
use App\Models\User;

class UserController extends Controller
{
    public function orders()
    {
        $user = Auth::user();

        $newOrders = Order::where('user_id', $user->id)
            ->where('created_at', '>=', now()->subMonths(3))
            ->count();

        return response()->json([
            'message' => 'success',
            'newOrders' => $newOrders
        ]);
    }

    public function shippings()
    {
        $user = Auth::user();

        $shippings = Order::where('user_id', $user->id)
            ->where('shipping_status', 'in_transit')
            ->count();

        return response()->json([
            'message' => 'success',
            'shippingCount' => $shippings
        ]);
    }

    public function getAddresses()
    {
        $user = Auth::user();

        $addresses = $user->addresses;

        return response()->json([
            'message' => 'success',
            'addresses' => $addresses
        ]);
    }
}
