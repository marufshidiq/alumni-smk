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
    return view('welcome');
});

Route::get('/auth', function () {
    return redirect()->route('front.login.get');
});

Route::get('/auth/newuser', 'RegistrationController@newRegistration')->name('front.new.get');
Route::get('/auth/login', 'RegistrationController@login')->name('front.login.get');
Route::get('/auth/proceed/{token}', 'RegistrationController@proceedRegistration');
Route::post('/auth/newuser', 'RegistrationController@sendNewRegistration')->name('front.new.post');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');