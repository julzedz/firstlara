<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function store(Request $request)
    {
      $cart = Cart::updateOrCreate(
        ['user_id' => auth()->id(), 'product_id' => $request->product_id],
        ['quantity' => $request->quantity]
      );
      return response()->json(['message' => 'Cart updated!', 'cart' => $cart]);
    }
}
