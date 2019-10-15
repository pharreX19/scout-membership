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

Route::view('tables','tables');

Route::view('/login', 'login')->name('login');

// Route::post('/users','UserController@store');
Route::post('login', 'AuthController@login');

Route::group(['middleware'=>'auth'], function(){
    Route::view('/register','register');

    Route::resource('ranks', 'RankController');
    Route::resource('users', 'UserController');
    Route::resource('members', 'MemberController');
    Route::resource('schools', 'SchoolController');
    Route::resource('atolls', 'AtollController');
    Route::resource('islands', 'IslandController');
    Route::resource('roles', 'RoleController');

    Route::get('/members-payments','MemberController@memberPayments');

    Route::any('/search-pending/{query?}', 'MemberController@searchPending');

    Route::get('read-notification/{id}', 'MemberController@readNotification');
    Route::view('/notifications', 'notifications');
    Route::get('logout', 'AuthController@logout');

    Route::view('profile','profile');

    Route::get('/', 'DashboardController@index');
});


// Route::view('datepicker','datepicker');
