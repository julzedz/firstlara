<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;

class Landingpage extends Component
{
  public $categories;
  public $products;



  public function mount()
  {
    try {
        $this->categories = Category::get();
        $this->products = Product::get();
    } catch (\Exception $e) {
        $this->categories = collect();
        $this->products = collect();
        // Optionally log the error or handle it as needed
        \Log::error('Error fetching categories or products: ' . $e->getMessage());
    }
  }
    public function render()
    {
        return view('livewire.landingpage');
    }
}
