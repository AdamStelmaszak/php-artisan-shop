<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class OrderComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        if((Auth::check() and Auth::user()->role === 'admin') or Auth::check() and Auth::user()->role === 'employee')
        {

            $orders = Order::paginate(9);
        }
        else
        {
            $orders = Order::where('user_id','=',Auth::user()->id)->paginate(9);
        }
        return view('livewire.order-component', compact('orders'));
    }
}
