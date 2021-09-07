<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function delete($user_id){
        $user = User::find($user_id);
        
        $user->delete();

        return redirect('dashboard');
    }

    public function promote($user_id){
        $user = User::find($user_id);
        $user->role_id = 1;
        $user->save();

        return redirect('dashboard');
    }

    public function create(Request $request){

        if (User::where('email', '=', $request->input('email'))->get()->isEmpty()){

        User::create(
            [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role_id' => 2,
            ]
        );
    }
        return back();
    }

    public function edit(Request $request, $user_id){
        $errors = [];

        if ($request->input('name') == '') $errors['name'] = 'Name is empty';
        if ($request->input('email') == '') $errors['email'] = 'E-mailil is empty';
        if ($request->input('password') == '') $errors['password'] = 'Password is empty';
        if (Role::find($request->input('role_id')) == null) $errors['role'] = 'Role is invalid';

        if (!empty($errors)){
            session(['errors' => $errors]);
            return back();
        };

        $user = User::find($user_id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request);
        $user->role_id = $request->input('role_id');

        $user->save();

        return redirect('dashboard');
    }
}
