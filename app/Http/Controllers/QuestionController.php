<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        $questions = json_decode($request->input('questions'), true);
        return response()->json( [ 'success' => ( Question::insert($questions) ) ], 200 );
    }
}
