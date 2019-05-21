<?php

namespace App\Http\Controllers;

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

    public function showWithRead($id) {
        $books = Book::all();

        foreach ($books as $book) {
            $book->user = UserBook::where('book_id', $book->id)->where('user_id', $id)->where('competition_id', 2)->get();
        }

        return $books;
    }
}
