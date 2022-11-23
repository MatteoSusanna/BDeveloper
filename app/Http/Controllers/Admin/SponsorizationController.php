<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sponsorization;
use App\SponsorizationUser;
use Braintree;
use Braintree\Gateway;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Braintree_Transaction;



class SponsorizationController extends Controller
{
    public function index()
{
    $sponsorizations = Sponsorization::all();
    $user = Auth::user();

    $userSponsorizations = SponsorizationUser::where('user_id', $user->id)->get();

    $gateway = new \Braintree\Gateway([
        // i dati li riprendiamo dal config precedentemente inizializzato
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    // genero il token e lo passo alla rotta, dentro la rotta in var client_token (script) mi riferisco a questo
    $token = $gateway->ClientToken()->generate();
        

    return view('admin.sponsorization.index', compact('sponsorizations', 'user', 'userSponsorizations', 'token'));

}

public function process(Request $request, Gateway $gateway)
{
    $payload = $request->input('payload', false);
    $nonce = $payload['nonce'];
    $sponsorization = Sponsorization::all();

    $price  = Sponsorization::where('price', $sponsorization->id)->first();

    if ($price == 1) {
        $amount = 2.99;
    } elseif ( $price == 2) {
        $amount = 5.99;
    } elseif ($price == 3) {
        $amount = 9.99;
    }
    

    // $gateway = new \Braintree\Gateway;
    $status = $gateway->transaction()->sale([
	'amount' => 10.00,
	'paymentMethodNonce' => $nonce,
	'options' => [
        'submitForSettlement' => True
	]
    ]);

    return response()->json($status);
}

protected $dates = [
    'starts_at',
    'ends_at',
];

public function store(){

    $data = request()->all();


    $user = Auth::user();
    $sponsorization = Sponsorization::find($data['sponsorization_id']);

    $userSponsorizations = SponsorizationUser::where('user_id', $user->id)->get();

    $userSponsorization = new SponsorizationUser();
    $userSponsorization->user_id = $user->id;
    $userSponsorization->sponsorization_id = $data['sponsorization_id'];

    $currentDateTime = Carbon::now();

    if($userSponsorizations->last() && $userSponsorizations->last()->ends_at > $currentDateTime){
        return redirect()->back()->with('status', 'errore');
    }else{
        $userSponsorization->starts_at = Carbon::now();
        $userSponsorization->ends_at = $currentDateTime->addHours($sponsorization->duration);
        $userSponsorization->fill($data);
        $userSponsorization->save();
    }



    return redirect()->route('admin.sponsorization');
}

}
