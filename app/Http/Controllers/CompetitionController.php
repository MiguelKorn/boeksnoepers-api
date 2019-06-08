<?php

namespace App\Http\Controllers;

use App\Competition;

class CompetitionController extends Controller
{
    public function index()
    {
        return Competition::with('userBooks')->get();
    }

    public function show($id)
    {
        return Competition::with('userBooks')->where('id', $id)->first();
    }
}
