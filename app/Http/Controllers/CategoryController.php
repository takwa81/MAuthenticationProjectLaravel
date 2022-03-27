<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('categories.index',compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("categories.create");
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
                "image" => "required"
            ]
        );
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension(); // you can also use file name
        $fileName = time() . '.' . $extension;
        $path = public_path() . '/images/categories/';
        $uplaod = $file->move($path, $fileName);

        $category = Category::create([
            "name" => $request->name,
            "image" => $fileName,

        ]);
        return redirect()->route('categories.index')->with(key: "success", value: "category added successflly");
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view("categories.show", compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view("categories.edit", compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if ($request->file('image') != null) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;
            $path = public_path() . '/images/categories/';
            $uplaod = $file->move($path, $fileName);
            if (File::exists(public_path('images/categories/' . $category->image))) {
                File::delete(public_path('images/categories/' . $category->image));
            } else {
                dd("error");
            }
            $category->image  = $fileName;
        }
        $category->name = $request->name ?? $category->name;
        $category->save();
        return redirect()->route('categories.index')->with(key: "success", value: "category update successflly");
    }


    public function destroy(Category $category)
    {
        $category->delete();
        if (File::exists(public_path('images/categories/' . $category->image))) {
            File::delete(public_path('images/categories/' . $category->image));
        } else {
            dd("error");
        }
        return redirect()->route('categories.index')->with(key: "success", value: "category deleted successflly");
    }
}
