<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// importata classe post per poter capire tramite dump come bloccare
// l errore che dava laravel quando la lista dei post e' vuota
//use App\Post;

class HomeController extends Controller
{
    public function index()
    {
        /* $data = [
            'posts' => Post::all()
        ];

        dump(Post::all()); */

        return view('admin.index');
    }
}
