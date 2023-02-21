<div class="container">
    <div class="row">
        @foreach ($products as $product)

        <div class="col-md-4 p-3">
            <div class="card">
              @if ((Auth::check() and Auth::user()->role === 'admin') or Auth::check() and Auth::user()->role === 'employee')
              <form action="{{route('product.destroy', ['product' => $product->id])}}" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-outline-danger">Delete</button>
              </form>
              <a href="{{route('product.edit', $product->id)}}">

                <button class="btn btn-outline-dark">Edit</button>
              </a>

              @endif
                <img src="{{asset($product->image->first()->path)}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{$product->name}}</h5>
                  <p class="card-text">{{$product->description}}</p>
                  @if($cart->where('id',$product->id)->count() >= 1)
                  <b>In cart</b>
                  @else
                  <a wire:click="add_to_cart({{$product->id}})" class="btn btn-outline-dark">Add to cart</a>
                  @endif
                </div>
              </div>
        </div>
        @endforeach
        <div class="my-2">
          {{$products->links()}}
        </div>
    </div>
</div>