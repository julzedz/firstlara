<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\WishlistRequest;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    //
    public function store(WishlistRequest $request)
    {
      $wishlist = Wishlist::create([
        'user_id' => auth()->id(),
        'product_id' => $request->product_id
      ]);
      return response()->json(['message' => 'Added to wishlist!', 'wishlist' => $wishlist]);
    }

    public function destroy(WishlistRequest $request)
    {
      $wishlist = Wishlist::where('user_id', auth()->id())
                ->where('product_id', $request->product_id)
                ->first();

      if ($wishlist) {
        $wishlist->delete();
        return response()->json(['message' => 'Removed from wishlist!']);
      }

      return response()->json(['message' => 'Item not found in wishlist!'], 404);
    }
}
