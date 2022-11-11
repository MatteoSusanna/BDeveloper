<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function index(){

        $data = request()->all();

        if($data['inputText'] == ''){
            $developers = User::with(['skill', 'specialization'])->get();
        }else{
            $developers = User::with(['skill', 'specialization'])->where('specialization_id', $data['specialization'])->get();
        }
        
        //passaggio cover
        foreach($developers as $developer){
            if($developer->cover){
                $developer->cover = asset('storage/' . $developer->cover);
            }else{
                $developer->cover = asset('img/user_segnaposto.png');
            }
        }
        //passaggio curriculum
        foreach($developers as $developer){
            if($developer->curriculum){
                $developer->curriculum = asset('storage/' . $developer->curriculum);
            }  
        }

        
        return response()->json([
            'status' => true,
            'results' => $developers
        ]);

    }
}
