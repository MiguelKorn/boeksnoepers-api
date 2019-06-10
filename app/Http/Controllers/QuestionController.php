<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->json()->all();
        return response()->json(['all'=>$request->all(), 'json'=>$data, 'content'=>json_decode($request->getContent(), true)]);
//        return response()->json( [ 'success' => ( Question::insert($data.data.questions) ) ], 200 );
    }
}
