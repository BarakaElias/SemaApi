<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Apikey;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Validator;

class AccountController extends Controller
{

    function create_account(Request $req){
        $rules = array(
            "email"=>"string|required|unique:accounts",
        );
    }
    //
    function activate_account(Request $req){
        $rules = array(
            "email"=>"string|required|unique:accounts",
        );

        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return $validator->errors();
        }

        

        //Then save the account credentials to db

        $account = new Account;
        $account->email = $req->email;
        // $account->password = Hash::make($req->password);
        $account->company_name = $req->company_name;
        $account->company_email = $req->company_email;
        $account->support_email = $req->support_email;
        $account->billing_email = $req->billing_email;
        $account->phone_number = $req->phone_number;
        $account->status = "Requests Activation";
        $account->save();

        //get user and update account id
        $user = DB::table('users')->where('email','=',$req->user_email)->update(['account_id'=>$account->id]);

        //Store the api keys we got from the HTtp get

        // $apikey = new Apikey;
        // $apikey->account_id = '3';
        // $apikey->api_secrets = json_decode('value returned by Http:get');
        // $apikey->save();

        //update the account id in user data 
        // $user = User::where('email', $req->email)->get();
        // $user->account_id = $account->id;


        return "Account Activated!";
    }


    function change_account_password(Request $req){
        return "Changing account password";
    }



    function fetch_account_api_keys(Request $req){
        return "Fetching account api keys";
    }


    function change_api_keys(Request $req){
        $rules = array(
            "platform"=>"required",
            "company_id"=>"required",
        );
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return $validator->errors();
        }



        //We should find the apikeys with company_id {} and platform {}
        $api_key = DB::table('apikeys')
                        ->where([['account_id','=',$req->company_id],['platform','=',$req->platform]])
                        ->update(['api_password'=>$req->api_password]);

        return "Succesfully changed!";
    }




    function handleUploadFile(Request $req){
        $input = $req->all();
        // return $req;
        if($req->hasFile('fileToUpload')){
            $destination_path = 'public/images';

            $image = $req->file('fileToUpload');

            $image_name = $image->getClientOriginalName();

            $path = $req->file('fileToUpload')->storeAs($destination_path, $image_name);
            return "yaya";


            $input['fileToUpload'] = $image_name;
            return "it has a file yay";
        }

        return "From upload file";

    }




    /* SEMA ADMINS */
    function fetchAccounts(Request $req){
        $accounts = Account::all();
        return $accounts;
    }
}
