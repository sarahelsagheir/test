<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Nicolaslopezj\Searchable\SearchableTrait;


class Book extends Model
{
    use Notifiable;
    use SearchableTrait;

     /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'books.title' => 10,
            'books.author' => 10,
            'books.category' => 5,
            'books.price' => 3,
        ]
    ];

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