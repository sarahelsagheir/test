<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Book extends Model
{
    use Notifiable;


    protected $fillable = [
        'title','cover_img','author','category','user_id'
    ];



    public function user()
    {
        return $this->belongsTo('App\User');
    }
   
}