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
    dd(config('theme.aaa'));
});


Route::get('/', function () {
    return view('theme.cryptoadmin.user.welcome');
});

//MultiAuth
Auth::routes();
Route::prefix('')->name('user.')->group(function(){
    Route::resource('/','UserController');
});



