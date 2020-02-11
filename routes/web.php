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
use App\Http\Controllers\NotificationController;
use App\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    $latestProducts= Book::latest()->take(3)->get();

    return view('store',[

            'latestProducts'=>$latestProducts

        ]);

});

Auth::routes(['verify' => true]); 
// route::get('/approvalRequest/{id}','NotificationController@index')->name('request.approve');
route::get('/approveNotification/{id}/{product}','NotificationController@approveNotification')->name('approve.notification');
route::get('/disapproveNotification/{id}','NotificationController@disapprovedNotification')->name('disapprove.notification');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/store', 'HomeController@store')->name('store');

// profile 
//---------------------chat-------------------------------
Route::get('/chat', 'HomeController@index')->name('home');
Route::get('/contacts', 'ContactsController@get');
Route::get('/conversation/{id}', 'ContactsController@getMessagesFor');
Route::post('/conversation/send', 'ContactsController@send');
Route::post('/conversation/send/{id}', 'ContactsController@sendMessage')->name('send.message');

//==================================================================
Route::get('/profile', 'ProfileController@profile')->name('profile');
Route::post('/profileUpdate', 'ProfileController@profileUpdate')->name('profileUpdate')->middleware('auth');
Route::get('/changePassword', 'ProfileController@changePasswordForm')->name('changePassword')->middleware('auth');
Route::post('/changePassword', 'ProfileController@changePassword')->name('changePassword')->middleware('auth');
Route::get('/profilePicture', 'ProfileController@getProfileAvatar')->name('profileAvatar')->middleware('auth');
Route::post('/profilePicture', 'ProfileController@profilePictureUpload')->name('profileAvatar')->middleware('auth');

//message count
// route::get('test/{message}',function($messages){
//   $messages=DB::table('messages')
//   ->where('read',1)
//   ->where('to',Auth::user()->id)
//   ->get();

  // foreach($messages as $message)
  // {
  //  json_encode($message->text);
  // }
//   return view('chat.RecievedMessage',[

//     'messages'=>json_encode($messages)

// ]);

// })->name('messageCount');

// shopping
Route::get('/products', 'ProductController@index')->name('product.index');
Route::get('/borrow', 'ProductController@borrowIndex')->name('borrow.index')->middleware('auth');
Route::get('/borrow/{product}/{id}', 'NotificationController@borrowRequest')->name('borrow.request')->middleware('auth');
Route::get('/sharedBook', 'ProductController@sharedBook')->name('sharedBook')->middleware('auth');
Route::get('/sharedBook/recieved/{product}', 'NotificationController@recievedBook')->name('recievedBook')->middleware('auth');


//-------------------------------------------rating---------------------------------------
Route::get('/showRate/{user}', 'RateController@rateNotification')->name('rateNotification')->middleware('auth');
Route::get('/rateUser/{user}', 'RateController@rateUser')->name('rateUser')->middleware('auth');
Route::post('/rateUser/{user}', 'RateController@rateShow')->name('rateShow')->middleware('auth');
Route::get('/rateBorrower/{user}', 'RateController@rateBorrower')->name('rateBorrower')->middleware('auth');

//------------------------------------------------------------------------------------------------------------
// Route::get('/borrow/{user}', 'RateController@borrow')->name('borrow')->middleware('auth');


// Route::get('/sharedBook/{product}', 'NotificationController@didnotRecievedNotification')->name('didnotRecievedNotification')->middleware('auth');

  //search
  Route::get('/live_search', 'LiveSearch@index');
  Route::get('/live_search/action', 'LiveSearch@action')->name('live_search.action');
  
  Route::post('/products', 'ProductController@search')->name('product.search');
  // search via ajax- axios
Route::view('/livesearch', 'livesearch');
Route::get('/searchAjax/{q}', 'ProductController@searchajax');
Route::get('user/{id}', 'RateController@show')->name('user.show');


Route::get('/addToCart/{product}', 'ProductController@addToCart')->name('cart.add');
Route::get('/shopping-cart', 'ProductController@showCart')->name('cart.show');
Route::get('/checkout/{amount}', 'ProductController@checkout')->name('cart.checkout')->middleware('auth');
Route::post('/charge', 'ProductController@charge')->name('cart.charge');
Route::get('/orders', 'OrderController@index')->name('order.index');
Route::delete('/products/{product}', 'ProductController@destroy')->name('product.remove');
Route::put('/products/{product}', 'ProductController@update')->name('product.update');
 

Route::get('/markAsRead',function(){
  auth()->user()->unreadNotifications->markAsRead();
});



Route::get('/addBook', 'ProfileController@getBookForm')->name('addBook')->middleware('auth');
Route::post('/addBook', 'ProfileController@addBook')->name('addBook')->middleware('auth');
Route::get('/books', 'ProfileController@getBooks')->name('books')->middleware('auth');
Route::delete('/books/{id}', 'ProfileController@deleteBook')->name('deleteBook')->middleware('auth');
  