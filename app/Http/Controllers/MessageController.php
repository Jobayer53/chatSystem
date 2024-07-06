<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Events\NewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // public function index(){
    //     $messages = Message::all();
    //     return view('index', ['messages' => $messages]);
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'message' => 'required',
    //     ]);
    //     $message = new Message();
    //     $message->message = $request->message;
    //     $message->save();
    //     return redirect('/message');
    // }
    // public function fetchMessages()
    // {
    //     $messages = Message::all();
    //     return response()->json(['messages' => $messages]);
    // }
    public function index()
    {
        $messages = Message::with('user')->get();
        return view('chat', compact('messages'));
    }

    public function store(Request $request)
    {
        $message = Message::create([
            'user_id' => Auth::user()->id,
            'message' => $request->input('content'),
        ]);


    $message->load('user'); // Ensure the user relation is loaded

    broadcast(new NewMessage($message))->toOthers();

    return response()->json($message);
    }
}
