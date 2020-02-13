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

//MultiAuth 用户身份验证相关的路由
Auth::routes(['verify' => true]);
Route::prefix('')->group(function() {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // 用户注册相关路由
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    // 密码重置相关路由
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

    // Email 认证相关路由
    Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

    //Admin
    Route::prefix('admin')->group(function() {
        Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
        Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
        //Password Reset Route
        Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showRequestForm')->name('admin.password.request');
        Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
        Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

    });

    //Member
    Route::prefix('member')->group(function() {
        Route::get('/login', 'Auth\MemberLoginController@showLoginForm')->name('member.login');
        Route::post('/login', 'Auth\MemberLoginController@login')->name('member.login.submit');
        Route::post('/logout', 'Auth\MemberLoginController@logout')->name('member.logout');

        //Password Reset Route
//        Route::post('/password/email', 'Auth\MemberForgotPasswordController@sendResetLinkEmail')->name('member.password.email');
//        Route::get('/password/reset', 'Auth\MemberForgotPasswordController@showRequestForm')->name('member.password.request');
//        Route::post('/password/reset', 'Auth\MemberResetPasswordController@reset')->name('member.password.update');
//        Route::get('/password/reset/{token}', 'Auth\MemberResetPasswordController@showResetForm')->name('member.password.reset');
    });
});



//User
Route::middleware('auth')->prefix('')->namespace('User')->name('')->group(function(){
    Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);
});

//Admin
Route::prefix('')->namespace('Admin')->name('')->group(function(){
    Route::resource('admin', 'AdminsController');
});

//Member
Route::prefix('')->namespace('Member')->group(function(){
    Route::resource('member', 'MembersController');
});


Route::get('/', function () {
    return view('theme.cryptoadmin.user.welcome');
});




