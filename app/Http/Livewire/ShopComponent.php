<?php

namespace App\Http\Livewire;

use App\Models\category;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\product;

use Cart;

class ShopComponent extends Component
{
    use WithPagination;
    public $pageSize = 12;
    public $orderBy = "Default Sorting";




    public function store($product_id,$product_name,$product_price){
        Cart::add($product_id,$product_name,1,$product_price)->associate('\App\Models\Product');
        session()->flash('success_message','Item addded in cart');
        return redirect()->route('shop.cart');
    }

    public function changePageSize($size){
        $this->pageSize = $size;
    }

    public function changeOrderBy($order){
        $this->orderBy = $order;
    }
    public function render()
    {
        if($this->orderBy == 'Price: Low to High' ){
            $products = product::orderBy('regular_price','ASC')->paginate($this->pageSize);
        }else  if($this->orderBy == 'Price: Low to High' ){
            $products = product::orderBy('regular_price','DESC')->paginate($this->pageSize);
        }else  if($this->orderBy == 'Price: Hight to Lowh' ){
            $products = product::orderBy('regular_price','ASC')->paginate($this->pageSize);
        }else  if($this->orderBy == 'Sort by newness' ){
            $products = product::orderBy('created_at','DESC')->paginate($this->pageSize);
        }else{
            $products = Product::paginate($this->pageSize);
        }
        $categories = category::orderBy('name','ASC')->get();
        return view('livewire.shop-component',['products'=>$products,'categories'=>$categories]); //passing the variables to the view
    }
}
