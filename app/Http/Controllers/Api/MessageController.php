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
            'name' => 'required|string|max:50|min:2',
            'lastname' => 'required|string|max:50|min:2',
            'email' => 'required|email',
            'text' => 'required|string|max:65000',
            "user_id" => "required"
        ],
        [
            'name.required' => 'La complilazione del nome è obligatoria',
            'name.max' => 'Il nome deve essere compreso tra 2 e 50 caratteri',
            'name.min' => 'Il nome deve essere compreso tra 2 e 50 caratteri',

            'lastname.required' => 'La complilazione del nome è obligatoria',
            'lastname.max' => 'Il cognome deve essere compreso tra 2 e 50 caratteri',
            'lastname.min' => 'Il cognome deve essere compreso tra 2 e 50 caratteri',

            'email.required' => 'La complilazione della email è obligatoria',
            'email.email' => "Il campo email deve essere un'indirizzo valido",

            'text.required' => 'La compilazione dell messaggio è obligatoria',
            'text.max' => 'Il messaggio deve avere un massimo di 65000 caratteri',
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
