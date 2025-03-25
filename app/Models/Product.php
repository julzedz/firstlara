<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    use HasFactory;

    protected $fillable = [
      'name', 'SKU', 'description', 'price', 'image', 'stock', 'category_id'
    ];

    public function category()
    {
      return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
      return $this->hasMany(OrderItem::class);
    }

    public function carts()
    {
      return $this->hasMany(Cart::class);
    }

    public function wishlists()
    {
      return $this->hasMany(Wishlist::class);
    }
}
