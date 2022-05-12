<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Apikey;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Validator;

class AccountController extends Controller
{
    //
    function activate_account(Request $req){
        $rules = array(
            "email"=>"string|required|unique:accounts",
            "password"=>"string|required"
        );

        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return $validator->errors();
        }

        //First login to the server to see if credentials are correct
        // $response = Http::post('url');




        //Then save the account credentials to db

        $account = new Account;
        $account->email = $req->email;
        $account->password = Hash::make($req->password);
        $account->save();

        //Store the api keys we got from the HTtp get

        // $apikey = new Apikey;
        // $apikey->account_id = '3';
        // $apikey->api_secrets = json_decode('value returned by Http:get');
        // $apikey->save();



        return "Account Activated!";
    }


    function change_account_password(Request $req){
        return "Changing account password";
    }



    function fetch_account_api_keys(Request $req){
        return "Fetching account api keys";
    }
}
