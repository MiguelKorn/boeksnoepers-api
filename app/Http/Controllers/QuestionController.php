<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        return response()->json( [ 'success' => ( Question::insert($request->input('questions')) ) ], 200 );
    }
}
