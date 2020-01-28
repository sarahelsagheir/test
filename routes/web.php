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

use App\Book;

Route::get('/', function () {
    $latestProducts= Book::latest()->take(3)->get();

    return view('store',[

            'latestProducts'=>$latestProducts

        ]);

});
// oute::get('/email', function () {
    // Mail::to('1@test.com')->send(new PurchaseSuccessful());
// 
    // return new PurchaseSuccessful;
// 
// });


Auth::routes(['verify' => true]); 


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/store', 'HomeController@store')->name('store');

// profile 
Route::get('/profile', 'ProfileController@profile')->name('profile');
Route::post('/profileUpdate', 'ProfileController@profileUpdate')->name('profileUpdate')->middleware('auth');
Route::get('/changePassword', 'ProfileController@changePasswordForm')->name('changePassword')->middleware('auth');
Route::post('/changePassword', 'ProfileController@changePassword')->name('changePassword')->middleware('auth');
Route::get('/profilePicture', 'ProfileController@getProfileAvatar')->name('profileAvatar')->middleware('auth');
Route::post('/profilePicture', 'ProfileController@profilePictureUpload')->name('profileAvatar')->middleware('auth');


// shopping
Route::get('/products', 'ProductController@index')->name('product.index');
Route::get('/borrow', 'ProductController@borrowIndex')->name('borrow.index');
  //search

  Route::post('/products', 'ProductController@search')->name('product.search');

Route::get('/addToCart/{product}', 'ProductController@addToCart')->name('cart.add');
Route::get('/shopping-cart', 'ProductController@showCart')->name('cart.show');
Route::get('/checkout/{amount}', 'ProductController@checkout')->name('cart.checkout')->middleware('auth');
Route::post('/charge', 'ProductController@charge')->name('cart.charge');
Route::get('/orders', 'OrderController@index')->name('order.index');
Route::delete('/products/{product}', 'ProductController@destroy')->name('product.remove');
Route::put('/products/{product}', 'ProductController@update')->name('product.update');
 




Route::get('/addBook', 'ProfileController@getBookForm')->name('addBook')->middleware('auth');
Route::post('/addBook', 'ProfileController@addBook')->name('addBook')->middleware('auth');
Route::get('/books', 'ProfileController@getBooks')->name('books')->middleware('auth');
Route::delete('/books/{id}', 'ProfileController@deleteBook')->name('deleteBook')->middleware('auth');
  