<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      "id" => $this->id,
      "quantity" => $this->quantity,
      "user_id" => $this->user_id,
      "product_id" => $this->product_id,
      "product" => new ProductResource($this->whenLoaded('product')),
      "created_at" => $this->created_at,
      "updated_at" => $this->updated_at
    ];
  }
}