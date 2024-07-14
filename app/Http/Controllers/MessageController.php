<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(){

        $users = User::where('id', '!=', Auth::User()->id)->orderByRaw('country = ? DESC', [Auth::user()->country])->get();
        return view('chat',[
            'users' => $users,
        ]);
    }

    public function store(Request $request) {
        $message = new Message();
        $message->message = $request->message;
        $message->sender_id = Auth::user()->id;
        $message->receiver_id = $request->receiver_id;
        $message->count = 1;
        $message->save();

        // Fetch updated messages after sending
        $messages = $this->getMessages($request->receiver_id);

        return response()->json($messages);
    }


    public function getMessages($id) {
        $messages = Message::where(function ($query) use ($id) {
                $query->where('sender_id', Auth::user()->id)
                      ->where('receiver_id', $id);
            })
            ->orWhere(function ($query) use ($id) {
                $query->where('sender_id', $id)
                      ->where('receiver_id', Auth::user()->id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return $messages;
    }


    public function getcount(){
        $data = Message::where('receiver_id',  Auth::User()->id)->where('count', 1)->count();
        return $data;
    }
    public function resetCount($receiver_id) {
        Message::where('receiver_id', Auth::user()->id)
               ->where('sender_id', $receiver_id)
               ->update(['count' => 0]);

        return response()->json(['status' => 'success']);
    }
}
