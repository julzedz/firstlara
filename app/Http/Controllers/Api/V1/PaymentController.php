<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Http\Resources\PaymentResource;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function processPayment(Request $request)
    {
      $payment = Payment::create([
        'user_id' => auth()->id(),
        'payment_date' => now(),
        'amount' => $request->amount,
        'payment_method' => $request->payment_method
      ]);
      return response()->json(['message' => 'Payment successful!', 'payment' => $payment]);
    }
}
