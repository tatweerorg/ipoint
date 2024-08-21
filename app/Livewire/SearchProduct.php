<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Modules\Product\Entities\Product;

class SearchProduct extends Component
{

    public $query;
    public $search_results;
    public $how_many;
    public function selectFirstProduct()
    {
        if ($this->search_results->isNotEmpty()) {
            $result = $this->search_results->first();
            $this->selectProduct($result);
            $this->resetQuery();
        }
    }

    public function mount() {
        $this->query = '';
        $this->how_many = 5;
        $this->search_results = Collection::empty();
    }

    public function render() {
        return view('livewire.search-product');
    }

    public function updatedQuery() {
      $products = Cache::get('products_cache', collect());

        // Filter cached products based on the search query
        $this->search_results = $products->filter(function ($product) {
            return stripos($product->product_name, $this->query) !== false ||
                   stripos($product->product_code, $this->query) !== false;
        })->take($this->how_many)->values();
    }

    public function loadMore() {
        $this->how_many += 5;
        $this->updatedQuery();
    }

    public function resetQuery() {
        $this->query = '';
        $this->how_many = 5;
        $this->search_results = Collection::empty();
    }

    public function selectProduct($product) {
        $this->dispatch('productSelected', $product);
    }
}
