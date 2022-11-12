<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function store(){

        $dati = request()->all();

        //Validazioni campi in data
        $validator = Validator::make($dati, [
            'name' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'email' => 'required|email',
            'text' => 'required|string|max:65000',
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
        $newMessage = new Message();
        $newMessage->fill($dati);
        $newMessage->save();

        return response()->json([
            'status' => true,
            'response' => $newMessage
        ]);



    }
}
