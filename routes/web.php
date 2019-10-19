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

Route::view('403','403');

Route::view('/login', 'login')->name('login');

Route::post('login', 'AuthController@login');

Route::group(['middleware'=>'auth'], function(){

    Route::get('/members-payments','MemberController@memberPayments');
    Route::any('/search-pending/{query?}', 'MemberController@searchPending');
    Route::post('/members/update-pending', 'MemberController@updatePending');

    Route::any('/search-member/{query?}', 'MemberController@searchMember');

    Route::get('download-documents/{id}', 'MemberController@download');

    // Route::get('read-notification/{id}', 'MemberController@readNotification');

    Route::view('/notifications', 'notifications');
    Route::get('logout', 'AuthController@logout');

    Route::get('print-members', 'MemberController@printMembers');


    Route::get('/', 'DashboardController@index');

    Route::view('/register','register');

    Route::resource('ranks', 'RankController');
    Route::resource('users', 'UserController');
    Route::resource('members', 'MemberController');
    Route::resource('schools', 'SchoolController');
    Route::resource('atolls', 'AtollController');
    Route::resource('islands', 'IslandController');
    Route::resource('roles', 'RoleController');

    Route::view('profile','profile');
});


// Route::view('datepicker','datepicker');
