<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController; 
use App\Http\Controllers\ForgotPassController;
use App\Http\Controllers\ResetPassController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/register', function () {
    return view('register');
})->middleware('guest');

Route::post('/store', [RegistrationController::class, 'store']);

Route::get('/login', function(){
    return view ('login');
})->middleware('guest');

Route::post('/authenticate', [LoginController::class, 'authenticate']);

/////////////////////////////////////

Route::get('/', function () {
    return view('login');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/welcome2', function () {
    return view('welcome2');
});

Route::get('/forgot-pass' ,[ForgotPassController::class,'showForgotPassForm'])->name('forgot.password.get');
Route::post('/forgot-pass' ,[ForgotPassController::class,'submitForgotPassForm'])->name('forgot.password.post');


Route::get('/rest-pass/{token}',[ResetPassController::class,'showResetPassForm'])->name('reset.password.get');
Route::post('/rest-pass',[ResetPassController::class,'submitResetPassForm'])->name('reset.password.post');
