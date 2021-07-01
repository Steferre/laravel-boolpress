# laravel-boolpress
azioni passo per passo per sviluppare il progetto:

1) da terminale inizializzare il progetto laravel lanciando il comando:
   composer create-project --prefer-dist laravel/laravel:7.0 (nome progetto)

2) in phpmyadmin creo un nuovo database

3) nel file.env inserisco i dati del nuovo database

4) sempre da terminale installare laravel ui con il comando:
   composer require laravel/ui:^2.4

5) si crea poi lo scaffolding auth con il comando:
   php artisan ui bootstrap --auth 
     

6) 
eseguite npm install per le dipendenze di sass e js.
create la migration per i Post
eseuite le migratrions
Creiamo la crud per i post con relative view (lato admin)
Creiamo la view index e show dei post lato pubblico