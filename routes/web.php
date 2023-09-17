<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ForgetPasswordController;
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

Route::prefix('auth')->group(function () {
  Route::controller(RegisterController::class)->group(function () {
      Route::get('/register','showRegistrationForm')->name('auth.register.form');
      Route::get('/register','register')->name('auth.register');
  });

  Route::controller(LoginController::class)->group(function (){
     Route::get('/login','showLoginForm')->name('auth.login.form');
     Route::get('/logout','logout')->name('auth.logout');
     Route::post('/login','login')->name('auth.login')->middleware('verified');
  });

  Route::controller(VerificationController::class)->middleware('auth')->group(function (){
     Route::get('email/send-verification','send')->name('auth.email.send-verification');
     Route::get('/email/verify','verify')->name('auth.email.verify');;
  });

  Route::controller(ForgetPasswordController::class)->group(function (){
     Route::get('/password/forget','showForgetForm')->name('auth.password.forget.form');
     Route::post('/password/forget','sendResetLink')->name('auth.password.forget');
     Route::get('/password/reset','showResetForm')->name('auth.password.reset.form');
     Route::post('password/reset','reset')->name('auth.password.reset');
  });
});
