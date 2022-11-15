<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeveloperController extends Controller
{
    public function index(){

        $data = request()->all();

        \Log::info($data);

        if($data['inputText'] == ''){

            $developers = User::with(['skill', 'specialization', 'review'])->get();

        }else{

            $developers = User::with(['skill', 'specialization', 'review'])->whereHas('specialization', function ($q){
                $data = request()->all();
                $q->where('specialization_id', $data['inputText']);
            })->get();      

        }
        
        //passaggio cover
        foreach($developers as $developer){
            if($developer->cover){
                $developer->cover = asset('storage/' . $developer->cover);
            }else{
                $developer->cover = asset('img/user-placeholder.png');
            }
        }
        //passaggio curriculum
        foreach($developers as $developer){
            if($developer->curriculum){
                $developer->curriculum = asset('storage/' . $developer->curriculum);
            } else{
                $developer->curriculum = asset('img/no-file.png');
            } 
        }

        //$avgVote = Review::groupBy('user_id')->sum('vote');
        

        return response()->json([
            'status' => true,
            'results' => $developers,
        ]);

    }

    public function show($slug){

        $developer = User::where('slug', $slug)->with(['skill', 'specialization'])->firstOrFail();

        //passaggio cover
        
            if($developer->cover){
                $developer->cover = asset('storage/' . $developer->cover);
            } else{
                $developer->cover = asset('img/user-placeholder.png');
            }
        
        //passaggio curriculum
        
            if($developer->curriculum){
                $developer->curriculum = asset('storage/' . $developer->curriculum);
            } else{
                $developer->curriculum = asset('img/no-file.png');
            }
        

        return response()->json([
            'status' => true,
            'result' => $developer
        ]);



    }

    public function getDeveloperLogged(){
        $developer = Auth::check();

        return response()->json([
            'status' => true,
            'result' => $developer
        ]);
    }
}
