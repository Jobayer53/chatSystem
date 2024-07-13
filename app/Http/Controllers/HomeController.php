<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // /**
    //  * Show the application dashboard.
    //  *
    //  * @return \Illuminate\Contracts\Support\Renderable
    //  */
    public function index()
    {
        return view('home');
    }

    public function user_register(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'country' => 'required',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->age = $request->age;
        $user->gender = $request->gender;
        $user->country = $request->country;
        $user->save();
        Auth::guard()->login($user);

        return redirect()->route('home');
    }
}
