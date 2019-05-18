<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';
    protected $fillable = [ 'title', 'description', 'image' ];

    public function questions()
    {
        return $this->hasMany( 'App\Question' );
    }

    public function locations()
    {
        return $this->belongsToMany( 'App\Location', 'book_location', 'book_id', 'location_id' )->withPivot( 'is_available' );
    }

    public function userBooks() {
        return $this->hasMany('App\UserBook');
    }
}
