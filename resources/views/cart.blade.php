@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-sm-6">
            @if($cart->count() == 0)
            <b>Nothing in cart.</b>
            @else
            <table class="table text-center">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">X</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                  <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->price}}.00$</td>
                    <td>
                      <form action="  {{route('cart.destroy', ['cart' => $item->rowId])}} " method="post">
                        @csrf
                        @method('delete')

                        <button class="btn btn-sm btn-danger">Delete</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                  <tr>
                    <th scope="row"></th>
                    <td>
                        <b>Total with tax:</b>
                    </td>
                    <td>{{Cart::total()}}$</td>
                  </tr>
                </tbody>
              </table>
              @if(Auth::check())
              <form action="{{route('order.store')}}" method="post">
                @csrf
                <button class="btn btn-sm btn-outline-secondary w-100 d-block">Order</button>
              </form>
              @else
              <a href="{{route('login')}}">
              <button class="btn btn-sm btn-outline-secondary w-100 d-block">Log in before ordering</button>
            </a>
              @endif
            @endif
        </div>
    </div>
</div>

@stop