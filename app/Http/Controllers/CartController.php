<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::content();
        return view('cart',compact('cart'));
    }

    public function destroy($id)
    {
        Cart::remove($id);
        return redirect()->route('cart.index');
    }
}