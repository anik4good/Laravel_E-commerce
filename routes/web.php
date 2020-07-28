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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Auth::routes(['verify' => false]);

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']],function ()
{
    route::get('dashboard','DashboardController@index')->name('dashboard');
    route::resource('tag','TagController');
    route::resource('category','CategoryController');
    route::resource('post','PostController');
    route::resource('subscriber','SubscriberController');
    route::resource('phone','PhoneController');
    //pending post
    route::get('pending','PostController@pending')->name('pendingpost');
    route::put('/post/{id}/approve/','PostController@approve')->name('approve');

    //Profile
    route::get('profile','ProfileController@index')->name('profile');
    route::put('profile-update','ProfileController@updateprofile')->name('profile.update');
    route::put('password-update','ProfileController@updatepassword')->name('password.update');

});



Route::group(['as'=>'author.','prefix'=>'author','namespace'=>'Author','middleware'=>['auth','author']],function ()
{
    route::get('dashboard','DashboardController@index')->name('dashboard');
    route::resource('post','PostController');

    //Profile
    route::get('profile','ProfileController@index')->name('profile');
    route::put('profile-update','ProfileController@updateprofile')->name('profile.update');
    route::put('password-update','ProfileController@updatepassword')->name('password.update');
});




Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
