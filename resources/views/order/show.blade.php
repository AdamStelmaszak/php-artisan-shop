@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-sm-6 text-center">
          <h4>Order</h4>

            <table class="table text-center">
                <thead>
                  <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Price</th>
                    <th scope="col">Is paid?</th>
                    <th scope="col">User</th>
                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <th scope="row">{{$order->id}}</th>
                    <td>{{$order->created_at->diffForHumans()}}</td>
                    <td>{{$order->price}}.00$</td>
                    <td>@if($order->is_paid) Yes @else No @endif</td>

                    <td>
                      @isset($order->user)
                      {{$order->user->name}}
                      @else
                      Factory-Fake
                      @endisset
                    </td>
                  </tr>


                </tbody>
              </table>
              <h4 class="mt-5">Products list</h4>
              <table class="table text-center">
                <thead>
                  <tr>
                    <th scope="col">Product ID</th>

                    <th scope="col">Price</th>
                    <th scope="col">Name of the product</th>
                  </tr>
                </thead>
                
                <tbody>
                  @foreach($sold_products as $item)
                  <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td>{{$item->price}}.00$</td>
                    <td>{{($item->name)}}</td>
                  </tr>
                  @endforeach
                  


                </tbody>
              </table>
        </div>
    </div>
</div>

@stop