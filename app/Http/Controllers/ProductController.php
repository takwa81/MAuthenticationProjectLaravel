<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function index()
    {
        // pagination
        $products = Product::latest()->get();
        return view("products.index", compact("products"));
    }

    public function create()
    {
        $categories  = Category::latest()->get();

        return view("products.create", compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "name" => "required",
                "image" => "required",
                "price" => "required",
                "category_id" => "required"

            ]
        );



        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension(); // you can also use file name
        $fileName = time() . '.' . $extension;
        $path = public_path() . '/images/products/';
        $uplaod = $file->move($path, $fileName);

        $product = Product::create([
            "name" => $request->name,
            "image" => $fileName,
            "price" => $request->price,
            "category_id" => $request->category_id,
            "description" => $request->description

        ]);
        return redirect()->route('products.index')->with(key: "success", value: "product added successflly");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories  = Category::latest()->get();

        return view("products.edit", compact('product', 'categories'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        if ($request->file('image') != null) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;
            $path = public_path() . '/images/products/';
            $uplaod = $file->move($path, $fileName);
            if (File::exists(public_path('images/products/' . $product->image))) {
                File::delete(public_path('images/products/' . $product->image));
            } else {
                dd("error");
            }
            $product->image = $fileName;
        }
        $product->name = $request->name ?? $product->name;
        $product->price = $request->price ?? $product->price;
        $product->category_id = $request->category_id ?? $product->category_id;
        $product->description = $request->description ?? $product->description;
        $product->save();

        return redirect()->route("products.index")->with(key: "success", value: "product update successflly");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        
        if ($product->delete() && File::exists(public_path('images/products/' . $product->image))) {
            File::delete(public_path('images/products/' . $product->image));
        } else {
            dd("error");
        }
        return redirect()->route('products.index')->with(key: "success", value: "category deleted successflly");
    }
}
