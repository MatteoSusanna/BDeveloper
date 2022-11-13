<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function store(){

        $dati = request()->all();

        //Validazioni campi in data
        $validator = Validator::make($dati, [
            'nome' => 'required|string|max:50',
            'cognome' => 'required|string|max:50',
            'messaggio' => 'required|string|max:65000',
            'voto' => 'required',
            "user_id" => "required"
        ]);

        //Se la validazione è fallita ritorna indietro errori
        if ($validator->fails()) {    
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ]);
        };

        
        //Inviamo il messaggio nel DB
        $newMessage = new Review();

        $newMessage->name = $dati['nome'];
        $newMessage->lastname = $dati['cognome'];
        $newMessage->text = $dati['messaggio'];
        $newMessage->vote = $dati['voto'];
        $newMessage->user_id = $dati['user_id'];

        $newMessage->save();

        return response()->json([
            'status' => true,
            'response' => $newMessage
        ]);
    }
}
