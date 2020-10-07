<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/movie/toprated/{page?}','MovieController@getByTopRated');
Route::get('/movie/genres/{genresId?}', 'MovieController@getByGenres');
Route::get('/movie/details/{movieId?}', 'MovieController@getMovie');
Route::get('/movie/{page?}', 'MovieController@getByPage');