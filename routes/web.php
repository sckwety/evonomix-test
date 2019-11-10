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

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');

Route::middleware('verified')->group( function () {

    Route::resource('photos', 'PhotoController')->except(['show']);

    Route::middleware('admin')
        ->prefix('admin')
        ->name('admin.')
        ->namespace('Admin')
        ->group( function () {

        Route::get('photos', 'PhotoController@index')->name('photos.index');

        Route::get('users', 'UserController@index')->name('users.index');

        Route::get('user/{user}/email/create', 'UserController@emailCreate')->name('user.email.create');

        Route::post('user/{user}/email/send', 'UserController@emailSend')->name('user.email.send');

    });

});
