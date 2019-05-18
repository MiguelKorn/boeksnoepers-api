<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $table = 'competition';

    public function userBooks() {
        return $this->hasMany('App\UserBook');
    }
}
