<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sound;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function mainPage(){
        $category = Category::all();
        if(isset($_GET['search'])){
            $category = Category::where('name', 'LIKE', '%'.$_GET['search'].'%')->get();
        }
        return view('main', [
            "categories" => $category->sortBy('name')
        ]);
    }

    public function getSoundByCategories(Category $category){
        $sound = $category->sounds;
        if(isset($_GET['search'])){
            $sound = Sound::where('title', 'Like', '%'.$_GET['search'].'%')->get();
        }
        return view('catalog', [
            'sounds' => $sound,
            'category' => $category
        ]);
    }
}
