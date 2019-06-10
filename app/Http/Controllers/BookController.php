<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Book;
use App\UserBook;

class BookController extends Controller
{
    public function index()
    {
        return Book::with( 'questions', 'locations' )->get();
    }

    public function show($id)
    {
        return Book::find( $id );
    }

    public function showWithQuestions($id)
    {
        return Book::with( 'questions' )->where( 'id', $id )->get();
    }

    public function showWithLocations($id)
    {
        return Book::with( 'locations' )->where( 'id', $id )->get();
    }

    public function showWithRead($id)
    {
        $books = Book::with( 'questions', 'locations' )->get();

        foreach ( $books as $book ) {
            $book->user = UserBook::where( 'book_id', $book->id )->where( 'user_id', $id )->where( 'competition_id', 3 )->get();
        }

        return $books;
    }

    public function getCurrentBook($id)
    {
        return UserBook::where( 'user_id', $id )->where( 'is_current', true )->get();
    }

    public function updateCurrentBook(Request $request)
    {
        $book = UserBook::where( 'is_current', true )
                        ->where( 'user_id', $request->input( 'user_id' ) )
                        ->where( 'competition_id', 3 )
                        ->first();

        if ( $book === null ) {
            $book                 = new UserBook();
            $book->user_id        = $request->input( 'user_id' );
            $book->book_id        = $request->input( 'new_book_id' );
            $book->competition_id = 3;
            $book->is_current     = true;
            return response()->json( [ 'book' => ( $book ), 'ac'=>'createnew' ], 200 );
        } else {
            if ( $request->has( 'new_book_id' ) ) {
                $book->book_id = $request->input( 'new_book_id' );
                return response()->json( [ 'book' => ( $book ), 'ac'=>'set new id' ], 200 );
            } else {
                $book->is_current = false;
                $book->score      = $request->input( 'score' );
                return response()->json( [ 'book' => ( $book ), 'ac'=>'setscore' ], 200 );
            }
        }

        return response()->json( [ 'success' => ( $book->save() ) ], 200 );
    }

    public function store(Request $request)
    {
        $book        = new Book();
        $book->id    = $request->input( 'id' );
        $book->title = $request->input( 'title' );
        $book->description  = $request->input( 'desc' );
        $book->image   = $request->input( 'img' );
        return response()->json( [ 'success' => ( $book->save() ) ], 200 );
    }
}
