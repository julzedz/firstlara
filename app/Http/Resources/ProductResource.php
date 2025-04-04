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
            'id' => $this->id,            // Product's unique identifier
            'name' => $this->name,        // Product name
            'SKU' => $this->SKU,          // Stock keeping unit code
            'description' => $this->description,  // Product description
            'price' => $this->price,      // Product price
            'stock' => $this->stock,      // Available stock quantity
            'category' => new CategoryResource($this->whenLoaded('category')), // Category details (when loaded)
            'image' => $this->image,      // Product image URL
            'created_at' => $this->created_at,   // Creation timestamp
            'updated_at' => $this->updated_at,   // Last update timestamp
        ];
    }
}