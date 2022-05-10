<?php

namespace App\Policies;

use App\Models\User;
use App\Models\sms_sender_id;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class sms_sender_idPolicy
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
        function register_sender_id(){
            
        }
        function update_sender_id(User $user){
            return $user->isSemaAdmin ? Response::allow() : Response::deny('You are not a Sema Administrator.');
        }
    }
}
