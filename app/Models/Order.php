<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    use HasFactory;

    protected $fillable = [
      'order_date', 'total_price', 'user_id', 'shipment_id', 'payment_id'
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function payment()
    {
      return $this->belongsTo(Payment::class);
    }

    public function shipment()
    {
      return $this->belongsTo(Shipment::class);
    }

    public function orderItems()
    {
      return $this->hasMany(OrderItem::class);
    }
}
