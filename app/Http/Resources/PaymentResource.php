<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
  public function toArray($request)
  {

    return [
      "id" => $this->id,
      "payment_date" => $this->payment_date,
      "payment_method" => $this->payment_method,
      "amount" => $this->amount,
      "user_id" => $this->user_id,
      // "user" => new UserResource($this->whenLoaded('user')),
      "orders" => OrderResource::collection($this->whenLoaded('orders')),
      "created_at" => $this->created_at,
      "updated_at" => $this->updated_at
    ];
  }
}