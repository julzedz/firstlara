<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'order_date' => $this->order_date,
      'total_price' => $this->total_price,
      'user_id' => $this->user_id,
      'shipment_id' => $this->shipment_id,
      'payment_id' => $this->payment_id,
      'order_items' => OrderItemResource::collection($this->whenLoaded('orderItems')),
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at
    ];
  }
}