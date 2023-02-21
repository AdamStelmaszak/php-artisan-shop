@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6  text-center mt-5">
            <h2>Add new product</h2>

            @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{route('product.store')}} " method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text">Product name</span>
                    <input type="text" name="name" class="form-control" placeholder="Product name" value="{{value:old('name')}}">
                    
                  </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Description</span>
                    <input type="text" name="description" class="form-control" placeholder="Description" value="{{value:old('description')}}">
                  </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">In Stock</span>
                    <input type="number" name="in_stock" min="1" class="form-control" placeholder="99" value="{{value:old('in_stock')}}">
                  </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Price</span>
                    <input type="number" name="price" min="1" class="form-control" placeholder="99" value="{{value:old('price')}}">
                  </div>
                  <div class="input-group mb-3">
                    <label class="input-group-text" >Image</label>
                    <input type="file" name="image" class="form-control" >
                  </div>
                  <button class="btn btn-outline-secondary w-100 d-block" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
@stop