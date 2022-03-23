<?php

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
    if (Auth::check()) {
        return view('home');
    }else{
        return redirect('login');
    }
    
    
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('/profile', 'App\Http\Controllers\User\UserController@profileUser')->name('profile');
});

Route::group(['prefix' => 'request', 'middleware' => 'auth'], function () {
    Route::get('/all-request', 'App\Http\Controllers\Request\RequestController@getAllRequest')->name('all-request');
    Route::get('/new-request', 'App\Http\Controllers\Request\RequestController@newRegisterRequest')->name('new-request');
    Route::post('/new-register', 'App\Http\Controllers\Request\RequestController@saveRequest')->name('request.register');
});


