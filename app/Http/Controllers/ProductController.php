<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Intervention\Image\Facades\Image;
use App\Models\Image as ImageModel;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function store(Request $request){

        $request->validate([
            'name' => 'required|max:50',
            'description' => 'required',
            'in_stock' => 'required|integer|max:255',
            'price' => 'required|integer|max:255',
            'image' => 'required',
        ]);

        $requestData = $request->all();
        $fileName = time().$request->file('image')->getClientOriginalName();
        // $fileName = time().$request->file('image')->getClientOriginalName();

        $path = $request->file('image')->storeAs('images', $fileName, 'public');
        $sq_path = $request->file('image')->storeAs('images', 'sq_'.$fileName, 'public');

       
        $requestData['path'] = 'storage/'.$path;
        $requestData['sq_path'] = 'storage/'.$sq_path;
        
        $img_sq = Image::make($request->file('image')->getRealPath());
        $img_sq->fit(200);
        $img_sq->save('storage/'.$sq_path);

        
        $img = Image::make($request->file('image')->getRealPath());
        
        $img->fit(500);
        $img->save('storage/'.$path);


        $product = Product::create($requestData);

        ImageModel::create([
            'path' => 'storage/'.$path,
            'sq_path' => 'storage/'.$sq_path,
            'product_id' => $product->id
        ]);

        return redirect()->route('admin.index')->with('message','Successfully added product');
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        if(((Auth::check() and Auth::user()->role === 'admin') or Auth::check() and Auth::user()->role === 'employee'))
        {
            return view('product.edit', compact('product'));
        }
        else
        {
            return redirect()->route('home');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'required',
            'in_stock' => 'required|integer|max:255',
            'price' => 'required|integer',
        ]);

        $requestData = $request->all();


        if(isset($requestData['image']))
        {
        $fileName = time().$request->file('image')->getClientOriginalName();

        $path = $request->file('image')->storeAs('images', $fileName, 'public');
        $sq_path = $request->file('image')->storeAs('images', 'sq_'.$fileName, 'public');

       
        $requestData['path'] = 'storage/'.$path;
        $requestData['sq_path'] = 'storage/'.$sq_path;
        

        
        $img_sq = Image::make($request->file('image')->getRealPath());
        $img_sq->fit(200);
        $img_sq->save('storage/'.$sq_path);

        
        $img = Image::make($request->file('image')->getRealPath());
        
        $img->fit(500);
        $img->save('storage/'.$path);

            ImageModel::create([
                'path' => 'storage/'.$path,
                'sq_path' => 'storage/'.$sq_path,
                'product_id' => $id
            ]);
        }

        $product = Product::findOrFail($id);

        $product->name = $requestData['name'];
        $product->description = $requestData['description'];
        $product->in_stock = $requestData['in_stock'];
        $product->price = $requestData['price'];
        $product->save();


        return redirect()->route('product.edit', $id)->with('message','Successfully updated product');
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('home');
    }
}
