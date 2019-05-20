<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function show($id)
    {
        return User::with('teacher')->where('id', $id)->get();
    }
}
