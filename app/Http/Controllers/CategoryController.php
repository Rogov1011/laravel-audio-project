<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category:: all()->sortBy('name');
        return view("categories.categories-list",[
            "categories"=>$categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("categories.create-category");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required']
        ]);
        $category = Category::create($request->all());
        $category -> uploadImage($request->file('image'));
        return redirect()->route("Category.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($categoryId)
    {
        $category = Category::find($categoryId);
        return view('categories.edit-category',[
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $categoryId)
    {
        $category = Category::find($categoryId);
        $category -> update([
            'name'=> $request->input('name')
        ]);
        $category ->uploadImage($request->file('image'));
        return redirect()->route("Category.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($categoryId)
    {
        Category::find($categoryId)->removeImg();
        return back();

    }
    public function removeImage($categoryId)
    {
        Category::find($categoryId)->removeImage();
        return back();

    }
}
