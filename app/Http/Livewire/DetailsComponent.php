<?php

namespace App\Http\Livewire;
use App\Models\product;
use Livewire\Component;
use Cart;

class DetailsComponent extends Component
{
    public $slug;
    public function mount($slug)
    {
        $this->slug = $slug;
    }
    public function store($product_id,$product_name,$product_price){
        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\product');
        session()->flash('success_message','Item added in cart');
        return redirect()->route('shop.cart');
    }
    public function render()
    {
        $product = product::where('slug',$this->slug)->first();
        $rproducts = product::where('category_id',$product->category_id)->inRandomOrder()->limit(4)->get();  //displaying products from the same category
        $nproducts = product::latest()->take(4)->get(); //get the latest products
        return view('livewire.details-component',['product'=>$product,'rproducts'=>$rproducts,'nproducts'=>$nproducts]);
    }
}
