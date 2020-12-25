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

Route::group(['middleware' => 'language'], function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('change-language/{language}', 'HomeController@changeLanguage')->name('change-language');
    Route::resource('posts', 'PostController');
    Auth::routes();
});
