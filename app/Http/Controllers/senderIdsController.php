<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\sms_sender_id;

use Validator;
use Carbon\Carbon;
class senderIdsController extends Controller
{
    //
    function getAllSenderIds(){
        // return ["id"=>"1","country"=>"Tanzania","name"=>"Sema","status"=>"Active","registered_networks"=>"list of registered networks"];
        return DB::select("SELECT * FROM sms_sender_ids");
    }


    function updateSenderId($id){
        return "updated";
    }

    function register_sender_id(Request $req){
        // return "registering id";
        $rules = array([
            "country"=>"required|string",
            "name"=>"Alpha|required|string|min:3|max:20",
            "status"=>"Alpha|required|IN:Active,Inactive",
        ]);
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return $validator->errors();
        }


        $sms_sender_id = new sms_sender_id;
        $sms_sender_id->country = $req->country;
        $sms_sender_id->name = $req->name;
        $sms_sender_id->status = $req->status;
        $sms_sender_id->registered_networks = $req->registered_networks;
        $sms_sender_id->actions = "edit, view, delete";
        $sms_sender_id->user = "isaac";
        $sms_sender_id->save();
        return $req;
    }

    function update_sender_id(Request $req){
        $rules = array([
            "country"=>"required|string",
            "name"=>"Alpha|required|string|min:3|max:20",
            "status"=>"Alpha|required|IN:Active,Inactive",
        ]);
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return $validator->errors();
        }


        $data = sms_sender_id::find($req->id);
        $sms_sender_id->country = $req->country;
        $sms_sender_id->name = $req->name;
        $sms_sender_id->status = $req->status;
        $sms_sender_id->registered_networks = $req->registered_networks;
        $sms_sender_id->save();
        
    }

    function delete_sender_id($id){
        $data = sms_sender_id::find($id);
        $data->delete();
        return "deleted";
    }




}
