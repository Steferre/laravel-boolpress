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

// tenere presente che la rotta /posts come tutte le altre che si possono creare avranno davanti api come prefisso, che le differenzia dalle rotte normali, che possono avere lo stesso nome
Route::get('/posts', 'Api\PostController@index');
