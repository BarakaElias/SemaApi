<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // dd($this->app['XeroService']->authorize());
    
    return view('welcome');
});





//after clicking the link in email, user is redirected to this view
Route::get('/reset-password/{token}', function ($token) {
    return view('resetpasswordform', ['token' => $token]);
});


Route::get('/manage/xero', [\App\Http\Controllers\XeroController::class, 'index'])->name('xero.auth.success');







//After submitting the new password from 
Route::post('/handle_password_reset',[userController::class, 'handle_password_reset']);




//routes for email verification
//1. Route to display a notice to the user to check email and click the ver link
//so that he cannot access some routes
Route::get('/email/verify', function(){
    return view('verify-email');
})->middleware('auth:sanctum')->name('verification.notice');




