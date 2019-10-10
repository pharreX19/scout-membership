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


Route::view('/login', 'login')->name('login');
Route::view('/register','register');

Route::post('login', 'AuthController@login');

Route::group(['middleware'=>'auth'], function(){


    Route::get('/', function () {
        return view('dashboard');
    });
    Route::get('logout', 'AuthController@logout');
    Route::resource('users', 'UserController');
    Route::resource('members', 'MemberController');
    Route::resource('schools', 'SchoolController');
    Route::resource('atolls', 'AtollController');
    Route::resource('islands', 'IslandController');
    Route::resource('roles', 'RoleController');

    Route::view('profile','profile');
});


// Route::view('datepicker','datepicker');
