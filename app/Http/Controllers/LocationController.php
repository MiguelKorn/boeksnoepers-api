<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        $locations = json_decode($request->input('locations'), true);
        return response()->json( [ 'success' => ( Location::insert($locations) ) ], 200 );
    }
}
