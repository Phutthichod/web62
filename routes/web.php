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

Route::get('/login',"MemberController@login");
Route::post('/login',"MemberController@checkLogin");
Route::get('/logout',"MemberController@logout");

Route::middleware(['web', 'index'])->group(function () {
    Route::get('/',"IndexController@index");
    Route::get('/{id}',"IndexController@index"); // change Mode (general,admin)

    Route::group(['prefix'=>'profile'],function(){
        Route::get('me',"MemberController@showProfile");
        Route::post('updateIcon',"MemberController@updateIcon");
        Route::post('updateEmail',"MemberController@updateEmail");
    });

});
