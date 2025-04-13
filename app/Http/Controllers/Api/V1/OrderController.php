<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use App\Http\Requests\OrderRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrderController extends Controller
{
  use AuthorizesRequests;
    public function index()
    {
        return OrderResource::collection(
            auth()->user()->orders()->with(['orderItems.product'])->get()
        );
    }

    public function store(OrderRequest $request)
    {
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_date' => now(),
            'total_price' => $request->total_price,
            'payment_id' => $request->payment_id,
            'shipment_id' => $request->shipment_id
        ]);
        
        return new OrderResource($order);
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        return new OrderResource($order->load(['orderItems.product']));
    }
} 