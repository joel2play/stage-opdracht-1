<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(){
        return view('profile.show')->with('user', Auth::user())->with('articles', Auth::user()->articles);
    }

    public function watch($user_id){
        return view('profile.show')->with('user', User::find($user_id))->with('articles', User::find($user_id)->articles);
    }

    public function save(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user = Auth::user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->profile_picture){
            Storage::delete($user->profile_picture);
            $user->profile_picture = $request->profile_picture->store('images/profiles');
        }

        $user->save();

        return redirect(route('profile.show'));
    }
}
