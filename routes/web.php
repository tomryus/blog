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
Route::get('/contact', 'web\FrontController@contact')->name('contact');
Route::get('/about', 'web\FrontController@about')->name('about');
Route::get('/article/{article}', 'web\FrontController@blogpost')->name('front.blogpost');
Route::get('/categories/{category}', 'web\FrontController@getCategory')->name('front.category');
Auth::routes();
Route::match(["GET", "POST"], "/register", function()
        {  
            return redirect("/login");
        })->name("register");

Route::group(['middleware' => 'auth'], function () {
    
    Route::resource('changepassword', 'PasswordController');
    Route::get('changepassword', 'PasswordController@change')->name('password.change');
    Route::put('changepassword', 'PasswordController@update')->name('password.update');
    
});

Route::get('/admin', 'HomeController@index');
Route::get('/admin/home', 'HomeController@index')->name('home');
Route::get('/admin/category/trash', 'CategoryController@trash')->name('category.trash');
Route::get('/admin/category/{id}/restore', 'CategoryController@restore')->name('category.restore');
Route::delete('/admin/category/{id}/deletepermanent', 'CategoryController@deletePermanent')->name('category.deletePermanent');
Route::resource('/admin/category', 'CategoryController');

Route::delete('/admin/article/{id}/deletepermanent', 'ArticleController@deletePermanent')->name('article.deletePermanent');
Route::get('/admin/article/trash', 'ArticleController@trash')->name('article.trash');
Route::get('/admin/article/{id}/restore', 'articleController@restore')->name('article.restore');
Route::resource('/admin/article', 'ArticleController');
