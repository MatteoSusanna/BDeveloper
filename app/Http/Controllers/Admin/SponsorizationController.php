<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sponsorization;
use App\SponsorizationUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SponsorizationController extends Controller
{
    public function index()
{
    $sponsorizations = Sponsorization::all();
    $user = Auth::user();

    $userSponsorizations = SponsorizationUser::where('user_id', $user->id)->get();

    return view('admin.sponsorization.index', compact('sponsorizations', 'user', 'userSponsorizations'));

}
protected $dates = [
    'starts_at',
    'ends_at',
];

public function store(){

    $data = request()->all();


    $user = Auth::user();
    $sponsorizations = Sponsorization::find($data['sponsorization_id']); //da mettere in add ore

    $userSponsorizations = SponsorizationUser::where('user_id', $user->id)->get();

    $userDelete = User::where('id', Auth::user()->id)->first();
    $userDelete->sponsorization()->sync([]); 

    $userSponsorization = new SponsorizationUser();

    $userSponsorization->user_id = $user->id;
    $userSponsorization->sponsorization_id = $data['sponsorization_id'];

    $currentDateTime = Carbon::now();

    if($userSponsorizations->last() && $userSponsorizations->last()->ends_at > $currentDateTime){
        return redirect()->back()->with('status', 'errore');
    }else{
        $userSponsorization->starts_at = Carbon::now();
        $userSponsorization->ends_at = $currentDateTime->addMinute($sponsorizations->duration);
        $userSponsorization->fill($data);


        $userSponsorization->save();
    }



    return redirect()->route('admin.sponsorization');
}

}
