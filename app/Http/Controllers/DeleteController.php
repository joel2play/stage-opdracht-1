<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function delete($user_id){
        $user = User::find($user_id);
        
        $user->delete();

        return redirect('dashboard');
    }
}
