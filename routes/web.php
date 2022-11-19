<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function(){
        // Route::get('/', 'HomeController@index');

        // Route::resource('profile', 'ProfileController');
        Route::get("/", "ProfileController@index")->name("index");
        Route::get("/edit", "ProfileController@edit")->name("edit");
        Route::put("/update", "ProfileController@update")->name("update");
        Route::delete("/destroy", "ProfileController@destroy")->name("destroy");

        //rotte messaggi
        Route::get('/message', 'MessageController@index')->name('message');
        Route::delete('/message/{message}', 'MessageController@delete')->name('message.delete');

        //rotta recensione
        Route::get('/review', 'ReviewController@index')->name('review');

        //rotta sponsorizzazione
        Route::get('/sponsorization', 'SponsorizationController@index')->name('sponsorization');
        // Route::get('/sponsorization', 'SponsorizationController@store')->name('sponsorization.store');
    });


Route::get('{any?}', function(){
    return view('guest.home');
})->where('any', '.*');
