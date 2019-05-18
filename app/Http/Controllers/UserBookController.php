<?php

namespace App\Http\Controllers;

use App\User;
use App\UserBook;
use Illuminate\Support\Facades\DB;

class UserBookController extends Controller
{
    public function index()
    {
        return UserBook::with( 'user', 'book', 'competition' )->get();
    }

    public function showUserBooksByCompetition($user, $competition)
    {
        return DB::table( 'user' )
                 ->join( 'user_book', 'user.id', '=', 'user_book.user_id' )
                 ->where( 'user.id', $user )
                 ->where( 'user_book.competition_id', $competition )
                 ->select( 'user.id', 'user.first_name', 'user.last_name_prefix', 'user.last_name', 'user.email', 'user.group', 'user.teacher' )
                 ->get();
    }

    public function showUsersByCompetition($id)
    {
        return DB::table( 'user' )
                 ->join( 'user_book', 'user.id', '=', 'user_book.user_id' )
                 ->where( 'user_book.competition_id', $id )
                 ->select( 'user.id', 'user.first_name', 'user.last_name_prefix', 'user.last_name', 'user.email', 'user.group', 'user.teacher' )
                 ->get();
    }
}
