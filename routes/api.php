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
Route::post('books', 'BookController@store');
Route::post('questions', 'QuestionController@store');
Route::post('locations', 'LocationController@store');

Route::get('users/{user}/competitions/{competition}', 'UserBookController@showUserBooksByCompetition');
Route::get('competitions/current', 'UserBookController@showUsersByCurrentCompetition');

Route::get('competitions', 'CompetitionController@index');
Route::get('competitions/{competition}', 'CompetitionController@show');

//TODO: add to middleware
Route::get('users/{id}', 'UserController@show');
Route::get('users/{id}/books', 'BookController@showWithRead');
Route::get('users/{id}/currentBook', 'BookController@getCurrentBook');
Route::post('users/currentBook', 'BookController@updateCurrentBook');