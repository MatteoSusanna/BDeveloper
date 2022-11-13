<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){
        $messages = Message::where('user_id', Auth::user()->id)->get();

        return view('admin.message.index', compact('messages'));
    }

    public function delete(Message $message){
        $message->delete();
        return redirect()->route('admin.message');
    }
}
