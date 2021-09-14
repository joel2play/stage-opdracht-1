<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function promote(User $auth_user, User $user){
        return $auth_user->role_id == Role::ADMIN && $user->role_id != Role::ADMIN;
    }

    public function demote(User $auth_user, User $user){
        return $auth_user->role_id == Role::ADMIN && $user->role_id != Role::USER && $user->id != 1;
    }

    public function delete(User $user){
        return $user->role_id == Role::ADMIN;
    }

    public function edit(User $user){
        return $user->role_id == Role::ADMIN;
    }

    public function deleteUser(User $auth_user, $user){
        return $auth_user->role_id == Role::ADMIN && $user->id != 1;
    }

    public function editProfile($auth_user, $user){
        return $auth_user->id == $user->id;
    }

    public function seeMenu($user){
        return $user->role_id == Role::ADMIN;
    }

    public function deleteArticle(User $auth, $article){
        return true;
    }
}
