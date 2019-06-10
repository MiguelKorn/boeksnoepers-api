<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->input('questions');

        return response()->json(['all'=>$data, 'content'=>json_decode($data, true)]);
//        return response()->json( [ 'success' => ( Question::insert($data.data.questions) ) ], 200 );
    }
}
