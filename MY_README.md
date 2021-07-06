# laravel-boolpress
azioni passo per passo per sviluppare il progetto:

PARTE DI PREPARAZIONE STRUTTURA PROGETTO

1) da terminale inizializzare il progetto laravel lanciando il comando:
   composer create-project --prefer-dist laravel/laravel:7.0 (nome progetto)

2) in phpmyadmin creo un nuovo database

3) nel file.env inserisco i dati del nuovo database

4) sempre da terminale installare laravel ui con il comando:
   composer require laravel/ui:^2.4

5) si crea poi lo scaffolding auth con il comando:
   php artisan ui bootstrap --auth
   dopo aver lanciato questo comando verranno create delle nuove cartelle che ci serviranno
   (nella cartella app/Http/Controllers comparira' una cartella Auth e il file HomeController.php)
   (nella cartella database/migrations comparira' una nuova migration create_password_resets_table.php)
   (nella cartella resources/js comparira' un nuovo file js bootstrap.js) 
   (nella cartella routes nel file web.php verranno create due rotte importanti Auth::routes(); e 
    Route::get('/home', 'HomeController@index')->name('home'); ) 
     
6) una volta eseguito il punto 5, lo stesso terminale suggerisce di eseguire i comandi:
   npm install;
   npm run dev;
   per compilare il nuovo scaffolding appena creato, operazione utile per poter usare anche sass e js

INIZIO PARTE OPERATIVA

7) a questo punto si puo' creare la migration per i Post che creera' la tabella Posts nel db comando:
   php artisan make:migration create_Posts_table
   inserire nella migration le colonne che ci servono nella tabella post 
   in seguito si crea anche il model e il controller per questa migration
   php artisan make:model Post
   php artisan make:controller --resource PostController
   (importare il model una volta creato il controller con use App\Post)
   questo primo controller per i post sara' quello lato pubblico, sara' necessario crearne uno per utenti loggati

8) eseguire le migration, laravel crea gia' una migration users che possiamo utilizzare:
   php artisan migrate 

9) adesso in web.php si creano le rotte per le pagine che vedra' un utente registrato e
   quelle per un utente solo visitatore che ovviamente saranno di sola lettura (index e show)
   (N.B. nel file web.php importare Illuminate\Support\Facades\Auth; se no Auth dara' errore)

10) nella cartella resources/views si creano una cartella che conterra' le view per l'utente registrato 
   (admin) mentre per gli utenti ospiti le rotte verranno lasciate nella cartella views

CREAZIONE RELAZIONI TRA TABELLE

11) e' necessario creare una FOREIGN KEY come per i database, i comandi sono:
    comando da terminale: add_column_to_posts_table
    crea una migration che aggiunge una colonna quella della foreign key
    (N.B. per creare la colonna della foreign e permettere la relazione, e' necessario che non ci siano dati nella tabella dei post)

12) nella migration add_column_to_posts_table inserisco questi dati:
    $table->unsignedBigInteger('user_id');

    $table->foreign('user_id')
       ->references('id')
       ->on('users');

13) i comandi al punto 12) possono essere condensati in un solo comando:
    $table->foreignId('user_id')
      ->constrained();

14) nella migration per creare la colonna foreign key mettere nella funzione down:
    $table->dropForeign('posts_user_id_foreign');
    $table->dropColumn('user_id');

    sono i comandi che verranno eseguiti per un eventuale roolback
    (posts_user_id_foreign e' un patterne che viene creato dal database prende come prima parte il nome della tabella dove si crea la foriegn key, il nome della colonna foreign key e la parola foreign tutto separato da underscore)

15) e' necessario aggiungere le relazioni anche nei model delle due tabelle
    per mappare una relazione dobbiamo creare una mapping tra tabela principale e secondaria e viceversa
    in entrambi i model va quindi registrata la relazione, che puo' essere di 1 a 1, di 1 a molti, e di molti a molti

16) codice da scrivere nel model per una relazione di 1 a molti:
    un user puo' avere molti post, viceversa un post puo' avere solo un user che lo genera:
    quindi nel model user scriviamo una funzione che mappa la relazione multipla con i post

    public function posts() il nome della funzione e' al plurale per evidenziare la relazione multipla
    return $this->hasMany('App\Post')
    funzione hasMany() identifica la relazione multipla e come argomento viene passato direttamente il model Post

    al contrario nel model Post verra' creata la funzione user() al singolare perche' un post puo' avere solo un utente padre e verra' usata la funzione belongsTo nel return e come argomento verra' passato il model User 

CREAZIONE RELAZIONE MOLTI A MOLTI

17a) prima di creare la migration per la tabella ponte e' necessario avere entrambe le tabelle disponibili a database, con relativi model ed eventuali seeder (se necessari) o crud nel controller

17b) in una relazione molti a molti e' necessario creare una tabella ponte, quindi si esegue una migration e come nome della tabella si usano i nomi delle due tabelle che si devono collegare al SINGOLARE e in ORDINE ALFABETICO separate da un UNDERSCORE

CREAZIONE ROTTE API

18) analogamente alle rotte create in web.php queste le scriveremo nel file api.php con stessa sintassi

19) creare un controller che va messo in una cartella dedicata (es Api come nome della cartella) i comandi artisan per la creazione del controller saranno gli stessi

20) come unica differenza i metodi creati nel controller non ritorneranno una view ma un file json, in quanto dovranno essere letti da un utente che ottiene i dati nel front tramite delle chiamate axios
codice da scrivere nel return della function:
   return response()->json()
   N.B. all interno del metodo json andra' passato un array di dati e non direttamente i dati che vogliamo passare al front, si crerea' una chiave a cui verranno associati i dati recuperati dal database, questa chiave sara' sempre la stessa per favorire il recupero dei dati stessi a chi li riceve nel front (esempio nome della chiave 'results')
