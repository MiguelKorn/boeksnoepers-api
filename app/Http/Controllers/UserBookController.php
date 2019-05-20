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

    public function showUsersByCurrentCompetition()
    {
        $users = DB::table( 'user' )
                   ->leftJoin( 'user_book', function ($join) {
                       $join->on( 'user.id', '=', 'user_book.user_id' )
                            ->where( 'user_book.competition_id', 2 )
                            ->orWhereNull( 'user_book.competition_id', null );
                   } )
//                 ->where( 'user_book.competition_id', $id )
                   ->where( 'user.group', 5 )
                   ->whereNotNull( 'user.teacher' )
                   ->select( 'user.id', 'user.first_name', 'user.last_name_prefix', 'user.last_name', 'user.email', 'user.group', 'user.teacher' )
                   ->groupBy( 'user.id' )
                   ->orderBy( 'first_name' )
                   ->get();

        foreach ( $users as $user ) {
            $user->books = UserBook::where( 'user_id', $user->id )->get();
        }

        return $users;
    }
}
