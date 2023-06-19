<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sound;
use Illuminate\Http\Request;

class SoundController extends Controller
{
    public function index()
    {

        return view('sounds.sounds-list', [
            'sounds' => Sound::all()
        ]);
    }

    public function createSound()
    {
        return view("sounds.create-sound", [
            'categories' => Category::all()->sortBy("name")
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'content' => ['required', 'min:3'],
            'category_id' => ['required'],
        ]);
        $sound = Sound::create($request->all());
        $sound->uploadSound($request->file('sound'));
        if(auth()->user()->is_admin){
            return redirect()->route("sound.index");
        } return redirect()->route("app.main")->with('successAdd', 'Звук успешно добавлен, ждите одобрения администратора!');
    }

    public function edit($soundId)
    {
        $sound = Sound::find($soundId);
        return view('sounds.edit-sound', [
            'sound' => $sound,
            'categories' => Category::all()

        ]);
    }
    public function update(Request $request, $soundId)
    {
        $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'content' => ['required', 'min:3'],
            'category_id' => ['required'],
        ]);
        $sound = Sound::find($soundId);
        $publish = 1;
        if(!$request->has(key:'is_published')){
            $publish = 0;
        }
        $sound->update([
            'title'=>$request->input('title'),
            'content'=>$request->input('content'),
            'category_id'=>$request->input('category_id'),
            'is_published'=>$publish
        ]);
        $sound->uploadSound($request->file('sound'));
        return redirect()-> route('sound.index')->with('success', 'Звук успешно обновлён');
    }

    public function destroy($soundId)
    {
        Sound::find($soundId)->remove();
        return back();
    }

    public function removeSound($soundId)
    {
        Sound::find($soundId)->removeSound();
        return back();
    }
}
