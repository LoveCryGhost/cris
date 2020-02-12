<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    session()->flash('success', '邮箱验证成功 ^_^');
    dd(session());
});


Route::get('/', function () {
    return view('theme.cryptoadmin.user.welcome');
});

//MultiAuth
Auth::routes(['verify' => true]);
Route::middleware('auth')->prefix('/')->namespace('User')->name('user.')->group(function(){
    Route::resource('profile','UserController');
});



