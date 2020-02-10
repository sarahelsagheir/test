<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    protected $fillable = ['book_id','user_id'];
        public function user() {
        
        return $this->belongsTo('App\User');
    }
    public function book()
    {

 return $this->hasMany('App\Book');

    }

}
