<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PromoteController extends Controller
{
    public function promote($user_id){
        $user = User::find($user_id);
        $user->role_id = 1;
        $user->save();

        return redirect('dashboard');
    }
}
