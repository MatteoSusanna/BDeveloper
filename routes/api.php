<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/developer', function (Request $request) {
    return $request->user();
});

//sviluppatori
Route::get('developer', 'Api\DeveloperController@index');

//specializazioni
Route::get('specializations', 'Api\SpecializationController@index');

//singolo sviluppatore
Route::get('developer/{slug}', 'Api\DeveloperController@show');


//messaggio
Route::post('message', 'Api\MessageController@store');

//recensione
Route::post('review', 'Api\ReviewController@store');

//sponsorizzazione
Route::get('sponsorization', 'Api\SponsorizationController@index');

Route::get('sponsorization/generate', 'Api\SponsorizationController@generate');
Route::post('sponsorization/make/payment', 'Api\SponsorizationController@makePayment');




