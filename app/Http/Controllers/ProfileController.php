<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(){
        return view('profile.show')->with('user', Auth::user());
    }

    public function watch($user_id){
        return view('profile.show')->with('user', User::find($user_id));
    }

    public function save(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user = Auth::user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        return redirect(route('profile.show'));
    }
}