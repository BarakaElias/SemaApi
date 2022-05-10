<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\senderIdsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/auth/token_gets_user', [userController::class, 'get_user_by_token']);

Route::post('reset_password',[userController::class, 'reset_password']);

/*
********************************************
            SEMA CLIENTS
********************************************/

//client
Route::post("loginuser",[userController::class, 'login_user']);

Route::middleware('auth:sanctum')->get("logoutuser",[userController::class, 'logout_user']);


//ADMIN
Route::middleware('auth:sanctum')->post("create_user", [userController::class, 'create_user']);

Route::post("register_new_client", [userController::class, 'register_new_client']);

Route::middleware('auth:sanctum')->delete("delete_user",[userController::class, 'delete_user']);

Route::get("list_users",[userController::class, 'list_users']);






















//sender ID
//get all senders
Route::middleware('auth:sanctum')->get("/list",[senderIdsController::class, 'getAllSenderIds']);

//update a sender ID
Route::middleware('auth:snactum')->put("list/{id}",[senderIdsController::class, 'updateSenderId']);

/*
********************************************
            AIMFRIMS ADMINS
*******************************************/


//FOR SENDER ID MANAGEMENT
//Registering a new ID
Route::middleware('auth:sanctum')->post("register_sender_id",[senderIdsController::class, 'register_sender_id']);

//updating an aid
Route::middleware('auth:sanctum')->put("update_sender_id",[senderIdsController::class, 'update_sender_id']);

//deleting an id
Route::middleware('auth:sanctum')->delete("delete_sender_id/{id}", [senderIdsController::class, 'delete_sender_id']);

