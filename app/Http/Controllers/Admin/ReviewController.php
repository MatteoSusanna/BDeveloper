<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(){
        $reviews = Review::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();

        return view('admin.review.index', compact('reviews'));
    }
}
