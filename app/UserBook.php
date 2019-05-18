<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBook extends Model
{
    protected $table = 'user_book';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function book()
    {
        return $this->belongsTo('App\Book');
    }

    public function competition()
    {
        return $this->belongsTo('App\Competition');
    }
}
