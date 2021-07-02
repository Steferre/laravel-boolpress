<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

use Illuminate\Support\Str;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'posts' => Post::all()
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // grazie a $request->all prendo tutte le coppie chiave valore inviate/registrate nel form dall utente
        // salvandole in postData ottengo un array associativo
        $postData = $request->all();
        // ora posso salvare questi dati in una nuova riga della mia tabella
        // prima di instanziare un nuovo fumetto creo una validazione per i dati che deve inserire l utente
        // grazie a laravel con il metodo validate
        // per la validazione prendo spunto dalla migration che ho creato per la tabella
        $request->validate([
            'title' => 'string|required|max:255',
            'content' => 'string|required',
        ]);
        // istanzio un nuovo fumetto
        $newPost = new Post();
        $newPost->title = $postData['title'];
        $newPost->description = $postData['content'];

        // procedura per generare lo slug
        $slug = Str::slug($newPost->title);

        $slugBase = $slug;
        // si va a verificare che lo slug non esista gia'
        $postAlreadyDone = 

        // per salvare i dati si usa il metodo save del Model
        $newPost->save();

        //essendo un metodo post il return della funzione non mi dara' una view
        // a tramite un redirect mi mostrera' la pagina dettagli del fumetto appena inserito
        return redirect()->route('admin.posts.show', $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
