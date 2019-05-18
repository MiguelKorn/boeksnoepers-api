<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post( 'register', 'Auth\RegisterController@register' );
Route::post( 'login', 'Auth\LoginController@login' );
Route::post( 'logout', 'Auth\LoginController@logout' );

Route::group(['middleware'=>'auth:api'], function(){
    Route::get('user', function(Request $request){
        return $request->user();
    });
});

Route::get( 'books', 'BookController@index' );
Route::get( 'books/{book}', 'BookController@show' );
Route::get( 'books/{book}/questions', 'BookController@showWithQuestions' );
Route::get( 'books/{book}/locations', 'BookController@showWithLocations' );

Route::get('users/{user}/competitions/{competition}', 'UserBookController@showUserBooksByCompetition');
Route::get('competitions/{competition}/users', 'UserBookController@showUsersByCompetition');

Route::get('competitions', 'CompetitionController@index');
Route::get('competitions/{competition}', 'CompetitionController@show');