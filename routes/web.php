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

Route::get('/auth/newuser', 'RegistrationController@newRegistration')->name('front.new.get');
Route::get('/auth/login', 'RegistrationController@login')->name('front.login.get');
Route::get('/auth/proceed/{token}', 'RegistrationController@proceedRegistration');
Route::post('/auth/newuser', 'RegistrationController@sendNewRegistration')->name('front.new.post');

Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('register', 'Auth\RegisterController@register')->name('register');
Route::get('/register', function () {
    return redirect()->route('front.new.get');
});
Route::get('/login', function () {
    return redirect()->route('front.login.get');
});

Route::get('/dashboard', 'HomeController@index')->name('dashboard');