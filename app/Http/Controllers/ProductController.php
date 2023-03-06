<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class ProductController extends Controller
{
    
    // public function index()
    // {
    //     $products = Product::latest()->paginate(5);
  
    //     return view('products.index',compact('products'))
    //         ->with('i', (request()->input('page', 1) - 1) * 5);
    // }
    public function index()
    {
        $role = Auth::user()->role;
        $products = Product::latest()->paginate(5);
       
        {
            return view('products.index',compact('products','role'));
            
        }
        
   
    }
   
    public function create()
    {
        return view('products.create');
    }
  
  
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
  
        Product::create($input);
   
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }
  
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }
   
 
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }
  
    
    public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required',
        'detail' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $input = $request->all();

    if($request->hasFile('image'))
    {
        $destination = 'image/'.$product->image;
        if(file::exists($destination))
        {
            File::delete($destination);
        }
   
        $destinationPath = 'image/';
        $profileImage = date('YmdHis') . "." . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move($destinationPath, $profileImage);
        $input['image'] = $profileImage;
    }

    $product->update($input);

    return redirect()->route('products.index')
                    ->with('success','Product updated successfully');
}
public function destroy(Product $product)
{
    // delete the image file if it exists
    if (file_exists(public_path('image/'.$product->image))) {
        unlink(public_path('image/'.$product->image));
    }

    $product->delete();

    return redirect()->route('products.index')
                    ->with('success','Product deleted successfully');
}
}