<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(
            Product::with(['category'])->paginate(20)
        );
    }

    public function show(Product $product)
    {
      return new ProductResource($product->load(['category']));
    }
} 