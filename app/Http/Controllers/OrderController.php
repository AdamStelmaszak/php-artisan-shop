<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\SoldProduct;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('order.index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_order = Order::create([
            'user_id' => Auth::user()->id,
            'price' => Cart::total(),
            'is_paid' => true
        ]);

        foreach(Cart::content() as $item)
        {

            SoldProduct::create([
                'name' => $item->name,
                'price' => $item->price,
                'qty' => 1,
                'product_id' => $item->id,
                'order_id' => $new_order->id,
                'user_id' => Auth::user()->id,
            ]);
        }
        
        Cart::destroy();

        return redirect()->route('order.show', ['order' => $new_order->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        $sold_products = $order->soldProduct;

        if((Auth::check() and Auth::user()->role === 'admin') or (Auth::check() and Auth::user()->role =='employee')) return view('order.show', compact('order','sold_products'));
            
        if(Auth::check() and $order->user_id == Auth::user()->id) return view('order.show', compact('order','sold_products')); return 'Not authenticated to see content';

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
