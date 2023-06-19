<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Sound;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {

        return view('reviews.review-list', [
            'reviews' => Review::all()
        ]);
    }

    public function createReview($soundId)
    {
        $sound = Sound::find($soundId);
        return view("reviews.review-create", [
            'sounds' => $sound
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_surname' => ['required'],
            'user_name' => ['required'],
            'email' => ['required', 'email'],
            'content' => ['required'],
            'sound_id' => ['required'],
        ]);
        Review::create($request->all());
        return redirect()->route("app.main")->with('successReview', 'Ваша жалоба отправлена администратору');
    }
    public function removeReview($reviewId)
    {
        Review::find($reviewId)->delete();
        return back();

    }
}
