<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Http\Resources\CartResource;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return CartResource::collection(
            Cart::with('product')->where('user_id', auth()->id())->get()
        );
    }

    public function show(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return new CartResource($cart->load('product'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::updateOrCreate(
            ['user_id' => auth()->id(), 'product_id' => $validated['product_id']],
            ['quantity' => $validated['quantity']]
        );
        return new CartResource($cart->load('product'));
    }

    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart->update($validated);
        return new CartResource($cart->load('product'));
    }

    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $cart->delete();
        return response()->json(['message' => 'Cart item removed']);
    }
}
