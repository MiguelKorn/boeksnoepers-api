<?php

namespace App\Http\Controllers;

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
        $books = Book::all();

        foreach ( $books as $book ) {
            $book->user = UserBook::where( 'book_id', $book->id )->where( 'user_id', $id )->where( 'competition_id', 2 )->get();
        }

        return $books;
    }

    public function updateCurrentBook(Request $request)
    {
        $book = UserBook::where( 'is_current', true )
                        ->where( 'user_id', $request->input( 'user_id' ) )
                        ->where( 'competition_id', 2 )
                        ->first();

        $book->book_id = $request->input( 'new_book_id' );

        return response()->json( [ 'success' => ( $book->save() ) ], 200 );
    }
}
