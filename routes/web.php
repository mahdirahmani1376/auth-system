<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
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
});

Route::prefix('auth')->group(function () {
  Route::controller(RegisterController::class)->group(function () {
      Route::get('/register','showRegistrationForm')->name('auth.register.form');
      Route::get('/register','register')->name('auth.register');
  });

  Route::controller(LoginController::class)->group(function (){
     Route::get('/login','showLoginForm')->name('auth.login.form');
     Route::post('/login','login')->name('auth.login');
  });
});
