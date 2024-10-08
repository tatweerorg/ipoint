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

  public function updatedQuerytext()
{
     $cacheKey = 'products_search_' . $this->query;

    // استرجاع البيانات من الكاش إذا كانت موجودة، وإلا قم بتنفيذ الاستعلام وتخزين النتيجة في الكاش
    $this->search_results = Cache::remember($cacheKey, 60, function () {
        return Product::where('product_name', 'like', '%' . $this->query . '%')
            ->orWhere('product_code', 'like', '%' . $this->query . '%')
            ->take($this->how_many)->get();
    });

    // الحصول على أول نتيجة واختيارها
    $result = $this->search_results->first();
    if ($result) {
        $this->selectProduct($result);
    }

    // إعادة تعيين قيمة الاستعلام
    $this->resetQuery();
 
 /*    
      $this->search_results = Product::where('product_name', 'like', '%' . $this->query . '%')
            ->orWhere('product_code', 'like', '%' . $this->query . '%')
            ->take($this->how_many)->get();
         $result = $this->search_results->first();
            $this->selectProduct($result);
             $this->resetQuery(); */

}
public function updatedQuery()
{
       $this->search_results = Product::where('product_name', 'like', '%' . $this->query . '%')
            ->orWhere('product_code', 'like', '%' . $this->query . '%')
            ->take($this->how_many)->get();
        

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
