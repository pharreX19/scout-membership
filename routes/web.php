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

Route::get('/', function () {
    return view('dashboard');
});


Route::view('/login', 'login');
Route::view('/register','register');

Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');


Route::resource('users', 'UserController');
Route::resource('members', 'MemberController');
Route::resource('schools', 'SchoolController');
Route::resource('atolls', 'AtollController');
Route::resource('islands', 'IslandController');
Route::resource('roles', 'RoleController');

Route::view('profile','profile');


Route::view('datepicker','datepicker');
