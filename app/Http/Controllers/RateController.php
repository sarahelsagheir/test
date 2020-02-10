<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use willvincent\Rateable\Rating;

class RateController extends Controller
{
    public function rateNotification($id){
        $user = User::find($id);
        return view('rate.showRate',compact('user'));
     
    }
    public function rateUser($id){
        $user = User::find($id);
        if($user->id != Auth::user()->id){
            return view('rate.index',compact('user'));
        }
        else{
            return view('home');
        }
    }

    public function rateShow(Request $request,$id)
    {
     request()->validate(['rate' => 'required']);
     $user= user::find($id);
     $rating = new \willvincent\Rateable\Rating;
     $rating->rating = $request->rate;
     $rating->user_id = auth()->user()->id;
     $user->ratings()->save($rating);
     return view('rate.index',compact('user'));
    }
    function borrow($id){
        
    }
  
}
