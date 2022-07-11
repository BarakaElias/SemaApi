<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\senderIdsController;
use App\Http\Controllers\AccountController;

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

/*
*************************************************
        AUTHENTICATION
************************************************/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/auth/token_gets_user', [userController::class, 'get_user_by_token']);


//password reset request
Route::post('reset_password_request',[userController::class, 'reset_password_request']);




// //routes for email verification
// //1. Route to display a notice to the user to check email and click the ver link
// //so that he cannot access some routes
// Route::get('/email/verify', function(){
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');


//2. route to handle requests generated when user clicks the link in the email




//3. route to resend a verification link if user is a dumbass

Route::post('/email/verification-notification', function(Request $req){
    $req->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['aut','throttle:6,1'])->name('verification.send');
















/*
********************************************
            SEMA CLIENTS
********************************************/

//client
Route::post("loginuser",[userController::class, 'login_user']);

Route::middleware('auth:sanctum')->get("logoutuser",[userController::class, 'logout_user']);


//ADMIN
Route::post("create_user", [userController::class, 'create_user']);

Route::post("register_new_client", [userController::class, 'register_new_client']);

Route::middleware('auth:sanctum')->delete("delete_user",[userController::class, 'delete_user']);

Route::get("list_users",[userController::class, 'list_users']);

Route::post("change_api_keys", [AccountController::class, 'change_api_keys']);



















/*
****************************************
            SEMA BACKEND ROUTES
***************************************/
Route::post('activate_account',[AccountController::class,'activate_account']);

Route::post('change_account_password',[AccountController::class, 'change_account_password']);

Route::post('fetch_account_api_keys',[AccountController::class, 'fetch_account_api_keys']);

Route::post('upload_file',[AccountController::class, 'handleUploadFile']);


Route::get('fetch_accounts',[AccountController::class, 'fetchAccounts']);






















//sender ID
//get all senders
Route::get("/list_senders",[senderIdsController::class, 'getAllSenderIds']);

//update a sender ID
Route::middleware('auth:snactum')->put("list/{id}",[senderIdsController::class, 'updateSenderId']);

/*
********************************************
            AIMFRIMS ADMINS
*******************************************/


//FOR SENDER ID MANAGEMENT
//Registering a new ID
Route::post("register_sender_id",[senderIdsController::class, 'register_sender_id']);

//updating an aid
Route::put("update_sender_id",[senderIdsController::class, 'update_sender_id']);

//deleting an id
Route::post("delete_sender_id", [senderIdsController::class, 'delete_sender_id']);

