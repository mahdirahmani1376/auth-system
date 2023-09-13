<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::prefix('auth')->name('auth')->group(function () {
  Route::controller(RegisterController::class)->group(function () {
      Route::get('/register','showRegistrationForm')->name('register.form');
      Route::get('/register','register')->name('register');
  });

  Route::controller(LoginController::class)->group(function (){
     Route::get('/login','showLoginForm')->name('login.form');
     Route::post('/login','login')->name('login')->middleware('verified');
  });

  Route::controller(VerificationController::class)->middleware('auth')->group(function (){
     Route::get('email/send-verification','send')->name('email.send-verification');
     Route::get('/email/verify','verify')->name('email.verify');;
  });
});
