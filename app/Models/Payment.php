<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //

    use HasFactory;

    protected $fillable = [ 'payment_date', 'payment_method', 'amount', 'user_id' ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function orders()
    {
      return $this->hasMany(Order::class);
    }
}
