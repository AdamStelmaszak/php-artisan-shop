<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\WithPagination;



class HomePageComponent extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    protected $listeners = ['refreshHomePage' => '$refresh'];
    
    public function render()
    {
        $products = Product::paginate(8);
        $cart = Cart::content();
        return view('livewire.home-page-component', compact('products','cart'));
    }

    public function add_to_cart($product_id):void
    {
        $product = Product::findOrFail($product_id);
        Cart::add($product->id, $product->name, 1, $product->price, 1);
        $this->emit('refreshHomePage');
    }
}
