<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'total_price' => 'required|numeric|min:0',
            'payment_id' => 'required|exists:payments,id',
            'shipment_id' => 'required|exists:shipments,id',
        ];
    }
} 