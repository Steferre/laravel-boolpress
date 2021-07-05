<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

//

// sezione rotte utente ospite
// un utente ospite avra' la possibilita' di vedere la lista dei post e leggere il singolo post
// solo due rotte index e show
Route::get('/', 'HomeController@index')->name('index');
Route::get('/posts', 'PostController@index')->name('posts.index');
Route::get('/posts/{post}', 'PostController@show')->name('posts.show');


// sezione rotte admin
Auth::routes();

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function() {
            Route::get('/', 'HomeController@index')->name('index');

            Route::get('/categories', 'CategoryController@index')->name('categories.index');

            Route::get('/tags', 'TagController@index')->name('tags.index');

            Route::get('/posts', 'PostController@index')->name('posts.index');

            Route::post('/posts', 'PostController@store')->name('posts.store');
            
            Route::get('/posts/create', 'PostController@create')->name('posts.create');
            
            Route::get('/posts/{post}', 'PostController@show')->name('posts.show');

            Route::match(['PUT', 'PATCH'], '/posts/{post}', 'PostController@update')->name('posts.update');
            
            Route::delete('/posts/{post}', 'PostController@destroy')->name('posts.destroy');
            
            Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts.edit');
    });


