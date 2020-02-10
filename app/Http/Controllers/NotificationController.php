<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Illuminate\Foundation\Auth\User;
use App\Notifications\BorrowRequest;

use App\Borrower;
use App\Notifications\AdminNotification;
use App\Notifications\ApproveNotification;
use App\Notifications\DisapprovedNotification;


use App\User as AppUser;

class NotificationController extends Controller
{
function borrowRequest($product, $id)
{
   $id=AppUser::find($id);
   $product=book::find($product);
$id->notify(new BorrowRequest($id,$product)); 
return back();       
}


 function approveNotification($id ,$product ){
  $id=AppUser::find($id);
  $product=book::find($product);
  if($product) {
    $product->status = '0';

    $product->save();
}
return redirect('/home');

   
  $id->notify(new approveNotification($id,$product));

 }
  Function  recievedBook( $product, $id){
 
    $book=book::find($product);


    if($book) {
      $book->status = '1';
      $book->borrower_id=$id;
      $book->save();
      return back();

  }

  return back();

}
 function disapprovedNotification($user){

    $user=AppUser::find($user);
    
    $user->notify(new DisapprovedNotification($user));
    return back();
}    
 function didnotRecievedNotification($user){
  $user=AppUser::find(3);
  

  $user->notify(new AdminNotification($user));

}    

}
