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

Auth::routes(['verify' => true]); 


Route::get('/home', 'HomeController@index')->name('home');
// profile 
Route::get('/profile', 'ProfileController@profile')->name('profile');
Route::post('/profileUpdate', 'ProfileController@profileUpdate')->name('profileUpdate');
Route::get('/changePassword', 'ProfileController@changePasswordForm')->name('changePassword');
Route::post('/changePassword', 'ProfileController@changePassword')->name('changePassword');
Route::get('/profilePicture', 'ProfileController@getProfileAvatar')->name('profileAvatar');
Route::post('/profilePicture', 'ProfileController@profilePictureUpload')->name('profileAvatar');


Route::get('/store', 'HomeController@store')->name('store');

Route::get('/products', 'ProductController@index')->name('product.index');
Route::get('/addToCart/{product}', 'ProductController@addToCart')->name('cart.add');

Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('/auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');
Route::get('/addBook', 'ProfileController@getBookForm')->name('addBook');
Route::post('/addBook', 'ProfileController@addBook')->name('addBook');
Route::get('/books', 'ProfileController@getBooks')->name('books');
Route::delete('/books/{id}', 'ProfileController@deleteBook')->name('deleteBook');
