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
Route::get('/address', function () {
    return redirect()->route('profile');
});

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/first', 'HomeController@first')->name('first');
Route::post('/address', 'HomeController@addressAddEdit')->name('address.addedit.form');
Route::post('/address/save', 'HomeController@addressSave')->name('address.save');
Route::post('/email/save', 'HomeController@emailSave')->name('email.save');
Route::post('/contact/save', 'HomeController@contactSave')->name('contact.save');
Route::post('/socialmedia/save', 'HomeController@socialMediaSave')->name('socialmedia.save');
Route::get('/profile/edit', 'HomeController@profileEdit')->name('profile.edit');
Route::post('/profile/edit', 'HomeController@profileEditProcess')->name('profile.edit.post');

Route::get('/profile/privacy/{type}/{id}', 'HomeController@profilePrivacy')->name('profile.privacy');
Route::get('/profile/delete/{type}/{id}', 'HomeController@profileDelete')->name('profile.delete');
Route::get('/profile/{slug}', 'HomeController@showProfile')->name('show.profile');