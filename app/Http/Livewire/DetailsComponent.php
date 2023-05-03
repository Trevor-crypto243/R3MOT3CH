<?php

namespace App\Http\Livewire;
use App\Models\product;
use Livewire\Component;

class DetailsComponent extends Component
{
    public $slug;
    public function mount($slug)
    {
        $this->slug = $slug;
    }
    public function render()
    {
        $product = product::where('slug',$this->slug)->first();
        $rproducts = product::where('category_id',$product->category_id)->inRandomOrder()->limit(4)->get();  //displaying products from the same category
        $nproducts = product::latest()->take(4)->get(); //get the latest products
        return view('livewire.details-component',['product'=>$product,'rproducts'=>$rproducts,'nproducts'=>$nproducts]);
    }
}
