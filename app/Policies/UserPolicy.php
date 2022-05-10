<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        function create_user(User $user){
            return $user->role === 'Administrator' ? Response::allow() : Response::deny('Only the Administrator can create user accounts!');
        }

        function delete_user(User $user){
            return $user->role == 'Administrator' ? Response::allow() : Response::deny('Only the Administrator can delete a user account!');
        }

        function update_user(User $user){
            //only update when the user either owns the account or is an Administrator
        }
    }
}
