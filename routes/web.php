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
Route::get('/home', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/first', 'HomeController@first')->name('first');
Route::post('/address', 'HomeController@addressAddEdit')->name('address.addedit.form');
Route::post('/address/save', 'HomeController@addressSave')->name('address.save');
Route::post('/email/save', 'HomeController@emailSave')->name('email.save');
Route::post('/contact/save', 'HomeController@contactSave')->name('contact.save');
Route::post('/socialmedia/save', 'HomeController@socialMediaSave')->name('socialmedia.save');
Route::post('/school/save', 'HomeController@schoolSave')->name('school.save');
Route::post('/industry/save', 'HomeController@industrySave')->name('industry.save');
Route::get('/profile/edit', 'HomeController@profileEdit')->name('profile.edit');
Route::post('/profile/edit', 'HomeController@profileEditProcess')->name('profile.edit.post');
Route::get('/avatar/edit', 'HomeController@avatarEdit')->name('avatar.edit');
Route::post('/avatar/edit', 'HomeController@avatarUpload')->name('avatar.upload');

Route::get('/profile/privacy/{type}/{id}', 'HomeController@profilePrivacy')->name('profile.privacy');
Route::get('/profile/delete/{type}/{id}', 'HomeController@profileDelete')->name('profile.delete');
Route::get('/profile/request/{user}/{type}/{id}', 'HomeController@profileRequest')->name('profile.request');
Route::get('/profile/{slug}', 'HomeController@showProfile')->name('show.profile');

Route::get('/public/institution/add', 'PublicInfoController@institutionAddView')->name('add.institution.get');
Route::post('/public/institution/add', 'PublicInfoController@institutionAdd')->name('add.institution');
Route::get('/public/industry/add', 'PublicInfoController@industryAddView')->name('add.industry.get');
Route::post('/public/industry/add', 'PublicInfoController@industryAdd')->name('add.industry');
Route::get('/public/major/add', 'PublicInfoController@majorAddView')->name('add.major.get');
Route::post('/public/major/add', 'PublicInfoController@majorAdd')->name('add.major');
Route::get('/public/class/add', 'PublicInfoController@classAddView')->name('add.class.get');
Route::post('/public/class/add', 'PublicInfoController@classAdd')->name('add.class');

Route::post('/class/list', 'PublicInfoController@classList')->name('class.list');

Route::get('/public/testimonial/add', 'PublicInfoController@testiAddView')->name('add.testi.get');
Route::post('/public/testimonial/add', 'PublicInfoController@testiAdd')->name('add.testi');
