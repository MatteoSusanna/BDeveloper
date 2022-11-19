<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class SponsorizationController extends Controller
{
    public function index(){

        $sponsorization = User::with(['skill', 'specialization', 'review', 'sponsorization'])->get();

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

        return response()->json([
            'status' => true,
            'results' => $sponsorization
        ]);
    }
}
