<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\User;
use Validator;

class userController extends Controller
{
    //login
    function login_user(Request $req){
        $rules = array(
            "email"=>"required|string|max:100",
            "password"=>"required|string",
        );
        $params = $req->params;

        // $validator = Validator::make($params, $rules);
        // if($validator->fails()){
        //     return $validator->errors();
        // }
        //logging the user in 
        $user = User::where('email',$params['email'])->first();
        if(!$user || !Hash::check($params['password'], $user->password)){
            return response([
                'message'=>['These credentials do not match our records']
            ], 404);
        }

        $user->status = "Active";
        $user->save();

        if($user->isAdmin == 1){

        }

        $token = $user->createToken('sema-token')->plainTextToken;

        $response = [
            'user'=>$user,
            'accessToken'=>$token
        ];


        return response($response, 201);
        // return $params['email'];
    }


    function logout_user(Request $req){
        $req->user()->currentAccessToken()->delete();
    }












    
    /*
    *******************************************
                SEMA CLIENTS
    ******************************************/
    //admins
    function create_user(Request $req){
        $rules = array(
            "username"=>"string|max:10",
            "first_name"=>"string|required|max:20",
            "last_name"=>"string|required|max:20",
            "email"=>"string|unique:users|required|email:rfc,dns",
            "phone_number"=>"max:12|string",
            "password"=>"string",
            "role"=>"IN:Administrator,Helper",
            // "company_id"=>"string|required",
        );

        // $validator = Validator::make($req->all(), $rules);
        // if($validator->fails()){
        //     return $validator->errors();
        // }else{

            //check if email already exists



            $user = new User;
            $user->first_name = $req->first_name;
            $user->last_name = $req->last_name;
            $user->email = $req->email;
            $user->username = $req->username;
            $user->phone_number = $req->phone_number;
            $user->isSemaAdmin = $req->isSemaAdmin;
            $user->role = $req->role;
            $user->password = Hash::make($req->password);
            // $user->company_id = $req->company_id;

            $user->save();
            return "User created";
        // }
    }








    function delete_user(Request $req){
        $rules = array(
            "id"=>"numeric"
        );
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return $validator->errors();
        }
        $user_to_delete = User::find($req->user_id);
        $user_to_delete->delete();
        return "User deleted";
    }









    function register_new_client(Request $req){
        $rules = array(
            'first_name'=>"string|max:20|required",
            "last_name"=>"string|max:20|required",
            'email'=>"string|max:23|required",
            'password'=>"string|required",
            'phone_number'=>"string|required|max:15"
        );

        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return $validator->errors();
        }
        $user = new User;
            $user->first_name = $req->first_name;
            $user->last_name = $req->last_name;
            $user->email = $req->email;
            $user->username = $req->first_name;
            $user->phone_number = $req->phone_number;
            $user->isSemaAdmin = false;
            $user->role = "Administrator";
            $user->password = Hash::make($req->password);
            $user->company_id = "2020";

        $user->save();
        return "Account created";
    }











    function get_user_by_token(Request $req){
        $token = PersonalAccessToken::findToken('hashedtoken');

        $user = $token->tokenable;
        return $user;
    }








    function list_users(Request $req){
        $users = User::where('company_id',$req->company_id)->get();
        return $users;
    }







    
    function reset_password(Request $req){
        $rules = array(
            "user_id"=>"string|required",
            "password"=>"string|required",
            "new_password"=>"string|required"
        );

        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return $validator->errors();
        }

        $user = User::find($req->user_id);

        if (Hash::check($req->password, $user->password)) {
            // The passwords match...
            $user->password = Hash::make($req->new_password);
            $user->save();
            return "Password succesfully changed";
        }    
    }
}
