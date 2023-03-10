<?php

use App\Http\Controllers\GoogleSocialiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('auth/google', [GoogleSocialiteController::class, 'redirect'])->name('google.login');
Route::get('auth/google/callback', [GoogleSocialiteController::class, 'callback'])->name('google.callback');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
