<?php

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

Route::prefix('auth')->controller(\App\Http\Controllers\RegisterController::class)->group(function () {
   Route::get('/register','showRegistrationForm')->name('auth.register.form');
   Route::get('/register','register')->name('auth.register');
});
