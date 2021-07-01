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
   questo primo controller per i post sara' quello lato pubblico, sara' necessario crearne uno per utenti loggati

8) eseguire le migration, laravel crea gia' una migration users che possiamo utilizzare:
   php artisan migrate   



eseuite le migratrions
Creiamo la crud per i post con relative view (lato admin)
Creiamo la view index e show dei post lato pubblico