<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    //
    public function store(Request $request)
    {
      $order = Order::create([
        'user_id' => auth()->id(),
        'order_date' => now(),
        'total_price' => $request->total_price,
        'payment_id' => $request->payment_id,
        'shipment_id' => $request->shipment_id
      ]);
      return response()->json(['message' => 'Order created!', 'order' => $order]);
    }
}
