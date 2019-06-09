<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->json()->all();
        dd(json_decode($request->getContent(), true));
        dd($request->all());

        return response()->json( [ 'success' => ( Question::insert($data.questions) ) ], 200 );
    }
}
