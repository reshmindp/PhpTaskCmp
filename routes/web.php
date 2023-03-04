<?php

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
Auth::routes();
Route::get('/', 'App\Http\Controllers\User\LoginController@login_page');

Route::group(['prefix'=>'user',  'as'=>'user.', 'middleware' => 'prevent-back-history'], function()
{
    Route::post('create', 'App\Http\Controllers\User\UserController@create_user')->name('create');
    Route::post('login', 'App\Http\Controllers\User\LoginController@login')->name('login');
    Route::get('dashboard', 'App\Http\Controllers\User\UserController@dashboard')->name('dashboard');

    Route::get('user-list', 'App\Http\Controllers\User\UserController@userlist')->name('list');
    Route::get('change-status/{id}', 'App\Http\Controllers\User\UserController@changeStatus')->name('change.status');
    
    Route::get('create-user','App\Http\Controllers\User\UserController@createnewuser')->name('createuser');

    Route::get('logout', 'App\Http\Controllers\User\LoginController@logout')->name('logout');





});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
