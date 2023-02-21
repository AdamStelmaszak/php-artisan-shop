@extends('layouts.main')

@section('content')
    <div>

    </div>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-sm-6">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Price</th>
                            <th scope="col">Is paid?</th>
                            <th scope="col">User</th>
                            <th scope="col">List</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <th scope="row">{{ $order->id }}</th>
                                <td>{{ $order->created_at->diffForHumans() }}</td>
                                <td>{{ $order->price }}.00$</td>
                                <td>
                                    @if ($order->is_paid)
                                        Yes
                                    @else
                                        No
                                    @endif
                                </td>
                                <td>
                                    @isset($order->user)
                                        {{ $order->user->name }}
                                    @else
                                        Factory-Fake
                                    @endisset
                                </td>
                                <td>
                                    <a href="/order/{{ $order->id }}">
                                        Show
                                    </a>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
    </div>

@stop
