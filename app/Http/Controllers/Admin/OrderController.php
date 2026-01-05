<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;


class OrderController extends Controller
{
    public function __construct()
    {   
        if(!Auth::guard('admin')->check()) {
            abort(403);
        }  
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $orders = Order::get();
        // $orderId = $orders->get('order_id');
        // $orderItem = OrderItem::where('order_id', $orderId)->get();

        
        // return view('admin.orders.index', compact('orders', 'orderItem'))

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
