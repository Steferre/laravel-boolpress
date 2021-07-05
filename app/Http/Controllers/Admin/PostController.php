<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;

use Illuminate\Support\Str;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'posts' => Post::all()
            //   ->where('user_id', $request->user()->id)
        ];

        // controllo del fatto se siano o meno presenti post
        // se non ci sono post verra' mostarto un errore generico
        // e non sara' visualizzato l errore di laravel con il codice in vista
        if (count(Post::all()) < 1) {
            abort('404');
        };


        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', ['categories' => $categories, 'tags' => $tags]);
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
        // prima di instanziare un nuovo post creo una validazione per i dati che deve inserire l utente
        // grazie a laravel con il metodo validate
        // per la validazione prendo spunto dalla migration che ho creato per la tabella
        $request->validate([
            'title' => 'string|required|max:255',
            'content' => 'string|required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'exists:tags,id'
        ]);
        // istanzio un nuovo fumetto
        $newPost = new Post();
        $newPost->title = $postData['title'];
        $newPost->content = $postData['content'];

        //aggiungo anche user_id
        $newPost->user_id = $request->user()->id;

        // procedura per generare lo slug
        $slug = Str::slug($newPost->title);

        $slugBase = $slug;
        // si va a verificare che lo slug non esista gia'
        $postAlreadyDone = Post::where('slug', $slug)->first();
        $contatore = 1;

        // faccio un ciclo while se il post risulta essere gia' presente nel db
        while($postAlreadyDone) {
            // entrando nel ciclo significa che il post e' hia' presente
            // e quindi anche il relativo slug
            // quindi ne devo creare uno leggermente diverso
            // in quanto lo slug deve essere univoco
            $slug = $slugBase . '-' . $contatore;
            $contatore++;
            // riverifico che lo slug creato con l'aggiunta del contatore sia il primo
            $postAlreadyDone = Post::where('slug', $slug)->first();
            // se non lo fosse verrebbe ripetuto il ciclo while
        }
        // in caso contrario uscendo dal ciclo while sono sicuro dell'univocita' dello slug
        // quindi lo assegno al nuovo post
        $newPost->slug = $slug;

        
        // faccio il controllo se ci siano tag aggiunti dall'utente
        if (!key_exists('tags', $postData)){
            $postData['tags'] = [];
        }

        // l'if mi passera' un array vuoto se non ci sono tag scelti 
        // in caso contrario aggiungo i tag
        $newPost->tags()->attach($postData['tags']);

        // per salvare i dati si usa il metodo save del Model
        $newPost->save();

        //essendo un metodo post il return della funzione non mi dara' una view
        // a tramite un redirect portero' l'admin alla lista dei post index
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //uso la dependencies injection e il metodo compact
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ];

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $modifiedPost = Post::findOrFail($post->id); 

        // come in store leggiamo tutti i dati passati dal form usando il metodo all di request
        $modifiedData = $request->all();

        $request->validate([
            'title' => 'string|required|max:255',
            'content' => 'string|required',
            'catgeory_id' => 'nullable|exists:categories,id',
            'tags' => 'exists:tags,id'
        ]);

        // attenzione alla modifica del titolo
        // se viene modificato, e' necessario ricreare lo slug
        if($modifiedData['title'] != $post->title) {
            // genero uno slug modificato
            $slug = Str::slug($modifiedData['title']);
            $slugBase = $slug;
            
            $postAlreadyDone = Post::where('slug', $slug)->first();
            $contatore = 1;

            while($postAlreadyDone) {
                $slug = $slugBase . '-' . $contatore;
                $contatore++;
                $postAlreadyDone = Post::where('slug', $slug)->first();
            }
            $modifiedData['slug'] = $slug;
        }

        $modifiedPost->title = $modifiedData['title'];
        $modifiedPost->content = $modifiedData['content'];

        if(!key_exists('tags', $modifiedData)){
            $modifiedData['tags'] = [];
        }

        $post->tags()->sync($modifiedData['tags']);

        $post->update($modifiedData);

        // tramite il metodo update aggiorniamo tutti i dati che abbiamo raccolto
        //$modifiedPost->update($modifiedData);

        // il return di questa funzione come per lo store non mostrera' una view
        // ma tramite un redirect ci mostrera' la pagina del dettaglio modificato
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        //non essendoci piu' la pagina del post che e' stato eliminato
        // non ci sara' il ritorno di una view ma un redirect alla home
        return redirect()->route('admin.index');
    }
}
