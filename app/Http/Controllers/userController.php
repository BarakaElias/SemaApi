<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Models\Account;
use App\Models\Apikey;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
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

        if(!$user->isSemaAdmin){
            $api_keys = Apikey::select('api_secrets')->where('account_id', $user->account_id)->get();
            if($api_keys){
                $user->api_secrets = $api_keys;
                // $user->api_keys = $api_keys[0]->api_secrets;
            }
            // $api_secrets = $DB::table('apikeys')->select('api_secrets','platform')->where('account_id','=',$user->company_id)->get();

            // if($api_secrets){
            //     $user->api_secrets = $api_secrets;
            //     $user->save();
            // }
        }

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
            "username"=>"string|required|max:10",
            "first_name"=>"string|required|max:20",
            "last_name"=>"string|required|max:20",
            "email"=>"string|unique:users|required",
            "phone_number"=>"max:12|string",
            "account_id"=>"required",
            "password"=>"string|min:8",
            "role"=>"IN:Administrator,Helper",
            // "company_id"=>"string|required",
        );



            $user = new User;
            $user->first_name = $req->first_name;
            $user->last_name = $req->last_name;
            $user->email = $req->email;
            $user->username = $req->username;
            $user->phone_number = $req->phone_number;
            $user->isSemaAdmin = false;
            $user->account_id = $req->account_id;
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


        // $account = new Accout;
        




        $user = new User;
            $user->first_name = $req->first_name;
            $user->last_name = $req->last_name;
            $user->email = $req->email;
            $user->username = $req->first_name;
            $user->phone_number = $req->phone_number;
            $user->isSemaAdmin = false;
            $user->role = "Administrator";
            $user->password = Hash::make($req->password);
            $user->account_id = "1";

        $user->save();


        //send verification email
        // event(new Registered($user));
        return "Account created";
    }











    function get_user_by_token(Request $req){
        $token = PersonalAccessToken::findToken('hashedtoken');

        $user = $token->tokenable;
        return $user;
    }








    function list_users(Request $req){
        $users = DB::table('users')->where('account_id','=',$req->account_id)->get();
        return $users;
    }







    
    function reset_password_request(Request $req){
        $rules = array(
            "user_id"=>"string|required",
            "password"=>"string|required",
            "new_password"=>"string|required"
        );

        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return $validator->errors();
        }  

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT ? back()->with(['status'=>__($status)])
        : back()->withErrors(['email'=> __($status)]);
    }
}









function handle_password_reset(Request $req){
    $rules = array([
        'token'=>'required',
        'email'=>'required|email',
        'password'=>'required|min:8|confirmed',]
    );

    $validator = Validator::make($req->all(), $rules);
    if($validator->fails()){
        return $validator->errors();
    }



    $status = Password::reset(
        $req->only('email','password','password_confirmation','token'),function($user, $password){
            $user->forceFill(['password'=>Hash::make($password)])->setRememberToken(Str::random(60));

            $user->save();
            event(new PasswordReset($user));
        }
    );


    return $status === Password::PASSWORD_RESET ? 
    redirect()->rooute('http://localhost:3000/auth/sing-in')->with('status',__($status)) :
     back()->withErrors(['email'=>[__($status)]]);
}