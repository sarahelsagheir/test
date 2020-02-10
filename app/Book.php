<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Book extends Model
{
    use Notifiable;


    protected $fillable = [
        'title','cover_img','author','price','category','user_id'
    ];



    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function borrower()
    {
        return $this->belongsTo('App\borrower');
    }

   
}