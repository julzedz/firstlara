<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    //
    public function store(Request $request)
    {
      $wishlist = Wishlist::create([
        'user_id' => auth()->id(),
        'product_id' => $request->product_id
      ]);
      return response()->json(['message' => 'Added to wishlist!', 'wishlist' => $wishlist]);
    }
}
