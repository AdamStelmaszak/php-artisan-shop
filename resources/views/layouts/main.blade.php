<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    @livewireStyles
</head>

<body class="bg-light">

    <div class="container mb-4 pt-2">

        <nav class="navbar justify-content-center navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Laravel Shop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/cart">Cart</a>
                        </li>
                        @if (Auth::check() and Auth::user()->role === 'admin' or Auth::check() and Auth::user()->role === 'employee')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.index') }}">Add product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('order.index') }}">All Orders</a>
                            </li>
                        @else
                            @if (Auth::check())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('order.index') }}">My Orders</a>
                                </li>
                            @endif
                        @endif

                        @if (!Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @else
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="btn btn-sm btn-outline-danger mt-1">Log Out</button>
                            </form>
                        @endif

                    </ul>

                </div>
            </div>
        </nav>
    </div>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    @livewireScripts
</body>

</html>
