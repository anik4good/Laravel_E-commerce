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
Auth::routes(['verify' => false]);

Route::get('/', 'HomeController@index');



Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']],function ()
{
    route::get('dashboard','DashboardController@index')->name('dashboard');
    route::resource('tag','TagController');
    route::resource('category','CategoryController');
    route::put('/category/{id}/active/','CategoryController@status')->name('category.status');
    //route::put('/category/{id}/deactive/','CategoryController@deactive')->name('category.deactive');
    //brand
    route::resource('brand','BrandController');
    route::put('/brand/{id}/active/','BrandController@status')->name('brand.status');

    //Product
    route::resource('product','ProductController');
    route::get('/product/pending','ProductController@pending')->name('product.pending');
    route::put('/post/{id}/approve/','ProductController@approve')->name('approve');
    route::put('/brand/{id}/active/','ProductController@status')->name('brand.status');

  //post
    route::resource('post','PostController');
    route::resource('subscriber','SubscriberController');
    route::get('pending','PostController@pending')->name('pendingpost');
    route::put('/post/{id}/approve/','PostController@approve')->name('approve');



    route::resource('phone','PhoneController');


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
