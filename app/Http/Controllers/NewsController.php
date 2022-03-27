<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::latest()->get();
        return view('news.index',compact("news"));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("news.create");

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
                "description" =>"required",
                "image" => "required",
            ]
        );



        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension(); // you can also use file name
        $fileName = time() . '.' . $extension;
        $path = public_path() . '/images/news/';
        $uplaod = $file->move($path, $fileName);

        $news = News::create([
            "name" => $request->name,
            "image" => $fileName,
            "description" => $request->description

        ]);
        return redirect()->route('news.index')->with(key: "success", value: "News added successflly");
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
    public function edit(News $news)
    {
        return view("news.edit", compact('news'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {

        if ($request->file('image') != null) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;
            $path = public_path() . '/images/news/';
            $uplaod = $file->move($path, $fileName);
            if (File::exists(public_path('images/news/' . $news->image))) {
                File::delete(public_path('images/news/' . $news->image));
            } else {
                dd("error");
            }
            $news->image = $fileName;
        }
        $news->name = $request->name ?? $news->name;
        $news->description = $request->description ?? $news->description;
        $news->save();

        return redirect()->route("news.index")->with(key: "success", value: "News update successflly");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {

        
        if ($news->delete() && File::exists(public_path('images/news/' . $news->image))) {
            File::delete(public_path('images/news/' . $news->image));
        } else {
            dd("error");
        }
        return redirect()->route('news.index')->with(key: "success", value: "News deleted successflly");
    }
}
