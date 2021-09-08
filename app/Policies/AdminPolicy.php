<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function seeDelete(User $user){
        return true;
        // $user->role_id == Role::ADMIN;
    }
}
