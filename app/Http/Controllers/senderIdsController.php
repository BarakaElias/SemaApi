<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\sms_sender_id;
use App\Models\Registered_network;

use Validator;
use Carbon\Carbon;
class senderIdsController extends Controller
{
    //
    function getAllSenderIds(){       
        $sms_sender_ids = sms_sender_id::all();
        return $sms_sender_ids;
    }


    function updateSenderId($id){
        return "updated";
    }

    function register_sender_id(Request $req){
        // return "registering id";
        $rules = array([
            "country"=>"required|string",
            "sender_name"=>"Alpha|required|string|min:3|max:20",
            "status"=>"Alpha|required|IN:Active,Inactive",
            "user"=>"email|required"
        ]);
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return $validator->errors();
        }


        $sms_sender_id = new sms_sender_id;
        $sms_sender_id->actions = "edit, view, delete";
        $sms_sender_id->country = $req->country;
        $sms_sender_id->name = $req->sender_name;
        $sms_sender_id->status = ($req->status) ? "Active" : "Inactive";
        $sms_sender_id->user = "isaac@aimfirms.com";
        $sms_sender_id->registered_networks = $req->registered_networks;
        $sms_sender_id->save();
        return "Successfully Registered ID";
    }









    //shows internal server error even though it records on the database
    function update_sender_id(Request $req){
        $rules = array([
            "id"=>"required",
            "country"=>"required|string",
            "name"=>"Alpha|required|string|min:2|max:20",
            "status"=>"required",
        ]);

        if($req->status){
            $req->status = "Active";
        }else{
            $req->status = "Inactive";
        }


        $data = DB::table('sms_sender_ids')->where('id',$req->id)->update(
            [
                'country'=>$req->country,
                'name'=>$req->name,
                'status'=>$req->status,
                'registered_networks'=>json_encode($req->registered_networks, true),
            ]
         );
        return "Successfully updated {$req->name}";    
    }







    function delete_sender_id(Request $req){
        // $rules = array(["id"=>"required"]);
        // $validator = Validator::make($req->all(), $rules);
        // if($validator->fails()){
        //     return $validator->errors();
        // }
        // return $req;

        // sms_sender_id::destroy((int)$req->id);

        $id_to_delete = sms_sender_id::find($req->id);
        $id_to_delete->delete();

        // $deleted = DB::table('sms_sender_ids')->where('id', '=', 11115)->delete();
        return $req;
    }




}
