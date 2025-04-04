<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
// This is a Laravel API Resource class that transforms Product model data
// into a standardized JSON response format. It extends JsonResource which
// provides the base transformation functionality.
class ProductResource extends JsonResource 
{
    /**
     * Transform the product model into an array.
     * This method defines how product data should be formatted when returned in API responses.
     * It includes basic product details like ID, name, price etc.
     * The category relationship is only included when it has been explicitly loaded.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'SKU' => $this->SKU,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'image' => $this->image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}