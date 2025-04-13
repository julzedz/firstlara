<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'quantity' => $this->quantity, 
      'price' => $this->price,
      'product_id' => $this->product_id,
      'order_id' => $this->order_id,
      'product' => new ProductResource($this->whenLoaded('product')),
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at
    ];
  }
}