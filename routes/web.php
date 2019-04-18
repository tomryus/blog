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

Route::get('/admin', 'HomeController@index');

Route::get('/', 'web\FrontController@index')->name('front');
Route::get('/article/{article}', 'web\FrontController@blogpost')->name('front.blogpost');
Route::get('/categories/{category_id}', 'web\FrontController@getCategory')->name('front.category');
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    
    Route::resource('changepassword', 'PasswordController');
    Route::get('changepassword', 'PasswordController@change')->name('password.change');
    Route::put('changepassword', 'PasswordController@update')->name('password.update');
    
});

Route::get('/admin', 'HomeController@index');
Route::get('/admin/home', 'HomeController@index')->name('home');
Route::resource('/admin/category', 'CategoryController');
Route::resource('/admin/article', 'ArticleController');
