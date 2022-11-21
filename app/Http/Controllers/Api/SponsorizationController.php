<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Review;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SponsorizationController extends Controller
{
    public function generate(Request $request) {
        return 'genarate';
    }
    public function makePayment(Request $request) {
        return 'makePayment';
    }
    public function index(){

        $sponsorization = User::with(['skill', 'specialization', 'review', 'sponsorization'])->whereHas('sponsorization', function($q){
            $q->where('ends_at', '>', Carbon::now());
        })->get();

        $review = Review::all();

        foreach($sponsorization as $developer){
            if($developer->cover){
                $developer->cover = asset('storage/' . $developer->cover);
            }else{
                $developer->cover = asset('img/user-placeholder.png');
            }
        }
        //passaggio curriculum
        foreach($sponsorization as $developer){
            if($developer->curriculum){
                $developer->curriculum = asset('storage/' . $developer->curriculum);
            } else{
                $developer->curriculum = asset('img/no-file.png');
            } 
        }

        $average = DB::table('reviews')->select('user_id', DB::raw('round(AVG(vote),0) as average'))
                    ->groupBy('user_id')->get();

        return response()->json([
            'status' => true,
            'results' => $sponsorization,
            'avg' => $average,
            'review' => $review

        ]);
    }
}
