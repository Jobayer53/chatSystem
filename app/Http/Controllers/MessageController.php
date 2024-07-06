<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){
        $messages = Message::all();
        return view('index', ['messages' => $messages]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);
        $message = new Message();
        $message->message = $request->message;
        $message->save();
        return redirect('/message');
    }
    public function fetchMessages()
    {
        $messages = Message::all();
        return response()->json(['messages' => $messages]);
    }
}
