<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function delete($user_id){
        $user = User::find($user_id);
        
        $user->delete();

        return redirect('admin');
    }

    public function promote($user_id){
        
        $user = User::find($user_id);
        $user->role_id = Role::ADMIN;
        $user->save();

        return redirect('admin');
    }

    public function demote($user_id){
        $user = User::find($user_id);
        $user->role_id = Role::USER;
        $user->save();

        return redirect('admin');
    }

    public function create(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'email|required',
            'password' => 'required',
        ]);

        if (User::where('email', '=', $request->input('email'))->get()->isEmpty()){

        User::create(
            [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role_id' => Role::USER,
            ]
        );
    }
        return redirect('admin');
    }

    public function edit(Request $request, $user_id){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role_id' => 'required'
        ]);

        $user = User::find($user_id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role_id');

        $user->save();

        return redirect('admin');
    }
}
