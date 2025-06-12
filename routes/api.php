<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistraController;
use App\Http\Controllers\AccediController;
use App\Http\Controllers\UtenteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\EpisodioController;
use App\Http\Controllers\IndirizzoController;
use App\Http\Controllers\RecapitoController;
use App\Http\Controllers\TipologiaIndirizzoController;
use App\Http\Controllers\TipologiaRecapitoController;
use App\Helpers\AppHelpers;
use App\Http\Controllers\ComuneController;

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

//LOGIN veloce per sviluppo
Route::get('/testLogin', function () {
    $hashUser = "c9a0a131b97d31031a391544280ce2223859fbf5d966481cc03198fe59ed40e038c0457a449430834db93575cda3f1a8dcb55e7bb72cb2268036d0be0706a612";
    $pwd = "3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79";
    $salt = "a0c299b71a9e59d5ebb07917e70601a3570aa103e99a7bb65a58e780ec9077b1902d1dedb31b1457beda595fe4d71d779b6ca9cad476266cc07590e31d84b206";

    $hashSalePsw = AppHelpers::creaHash($pwd, $salt);

    AccediController::testLogin($hashUser, $hashSalePsw);
});


// API OSPITE

//crea nuovo utente, indirizzo mail, username e password
Route::post("/registra", [RegistraController::class, 'store']);
//accesso utente con username e password
Route::get("/accedi/{username}/{password?}", [AccediController::class, 'show']);

//mostra un utente
Route::get("/utenti/{utente}", [UtenteController::class, 'show']);

//mostra tutti i comuni
Route::get("/comuni", [ComuneController::class, 'index']);
//mostra un comune
Route::get("/comuni/{idComune}", [ComuneController::class, 'show']);

// API CON AUTENTICAZIONE MEMBRO E AMMINISTRATORE
Route::middleware(['autenticazione', 'statoUtente:attivo', 'permessoUtente:Amministratore,Membro'])->group(function () {

    //modifica password
    Route::get("/accedi/{idUtente}/{vecchiaPssw}/{nuovaPssw}", [AccediController::class, 'modify']);

    //mostra un utente
    Route::get("/utenti/{utente}", [UtenteController::class, 'show']);
    //modifica utente
    Route::put("/utenti/{utente}", [UtenteController::class, 'update']);

    //mostra tutte le categorie
    Route::get("/categorie", [CategoriaController::class, 'index']);
    //mostra una categoria
    Route::get("/categorie/{idCategoria}", [CategoriaController::class, 'show']);

    //mostra tutti i films
    Route::get("/films", [FilmController::class, 'index']);
    //mostra tutti i films di una data categoria
    Route::get("/films/categoria/{idCategoria}", [FilmController::class, 'index']);
    //mostra un film
    Route::get("/films/{idFilm}", [FilmController::class, 'show']);

    //mostra tutte le series
    Route::get("/series", [SerieController::class, 'index']);
    //mostra tutte le series di una data categoria
    Route::get("/series/categoria/{idCategoria}", [SerieController::class, 'index']);
    //mostra una serie
    Route::get("/series/{idSerie}", [SerieController::class, 'show']);

    //mostra tutti gli episodi
    Route::get("/episodi", [EpisodioController::class, 'index']);
    //mostra tutti gli episodi di una data serie
    Route::get("/episodi/serie/{idSerie}", [EpisodioController::class, 'index']);
    //mostra un episodio
    Route::get("/episodi/{idEpisodio}", [EpisodioController::class, 'show']);

    //mostra un indirizzo
    Route::get("/indirizzi/{idIndirizzo}", [IndirizzoController::class, 'show']);
    //mostra tutti gli indirizzi di un dato utente
    Route::get("/indirizzi/utente/{idUtente}", [IndirizzoController::class, 'index']);
    //crea nuovo indirizzo
    Route::post("/indirizzi", [IndirizzoController::class, 'store']);
    //modifica un indirizzo
    Route::put("/indirizzi/{idIndirizzo}", [IndirizzoController::class, 'update']);
    //elimina indirizzo
    Route::delete("/indirizzi/{idIndirizzo}", [IndirizzoController::class, 'destroy']);

    //mostra un recapito
    Route::get("/recapiti/{idRecapito}", [RecapitoController::class, 'show']);
    //mostra tutti i recapiti di un dato utente
    Route::get("/recapiti/utente/{idUtente}", [RecapitoController::class, 'index']);
    //crea nuovo recapito
    Route::post("/recapiti", [RecapitoController::class, 'store']);
    //modifica un recapito
    Route::put("/recapiti/{idRecapito}", [RecapitoController::class, 'update']);
    //elimina recapito
    Route::delete("/recapiti/{idRecapito}", [RecapitoController::class, 'destroy']);

    //mostra tutte le tipologie di indirizzo
    Route::get("/tipologieIndirizzo", [TipologiaIndirizzoController::class, 'index']);

    //mostra tutte le tipologie di recapito
    Route::get("/tipologieRecapito", [TipologiaRecapitoController::class, 'index']);
});

// API CON AUTENTICAZIONE AMMINISTRATORE
Route::middleware(['autenticazione', 'statoUtente:attivo', 'permessoUtente:Amministratore'])->group(function () {

    //mostra tutti gli utenti
    Route::get("/utenti", [UtenteController::class, 'index']);
    //mostra tutti gli utenti con un dato stato
    Route::get("/utenti/stato/{idStato}", [UtenteController::class, 'index']);
    //mostra tutti gli utenti con un dato permesso
    Route::get("/utenti/permesso/{idPermesso}", [UtenteController::class, 'index']);
    //elimina utente
    Route::delete("/utenti/{utente}", [UtenteController::class, 'destroy']);

    //modifica lo stato di un utente:
    //Attivato
    Route::get("/utenti/attiva/{utente}", [UtenteController::class, 'attivaStato']);
    //Disattivato
    Route::get("/utenti/disattiva/{utente}", [UtenteController::class, 'disattivaStato']);
    //Sospeso
    Route::get("/utenti/sospendi/{utente}", [UtenteController::class, 'sospendiStato']);

    //modifica il permesso di un utente:
    //Amministratore
    Route::get("/utenti/amministratore/{utente}", [UtenteController::class, 'rendiAmministratore']);
    //Membro
    Route::get("/utenti/membro/{utente}", [UtenteController::class, 'rendiMembro']);
    //Ospite
    Route::get("/utenti/ospite/{utente}", [UtenteController::class, 'rendiOspite']);

    //crea nuova categoria
    Route::post("/categorie", [CategoriaController::class, 'store']);
    //modifica una categoria
    Route::put("/categorie/{idCategoria}", [CategoriaController::class, 'update']);
    //elimina categoria
    Route::delete("/categorie/{idCategoria}", [CategoriaController::class, 'destroy']);

    //uploadFile
    Route::post("/upload", [RegistraController::class, 'index']);

    //crea nuovo film
    Route::post("/films", [FilmController::class, 'store']);
    //modifica un film
    Route::put("/films/{idFilm}", [FilmController::class, 'update']);
    //elimina film
    Route::delete("/films/{idFilm}", [FilmController::class, 'destroy']);

    //crea nuova serie
    Route::post("/series", [SerieController::class, 'store']);
    //modifica una serie
    Route::put("/series/{idSerie}", [SerieController::class, 'update']);
    //elimina serie
    Route::delete("/series/{idSerie}", [SerieController::class, 'destroy']);

    //crea nuovo episodio
    Route::post("/episodi", [EpisodioController::class, 'store']);
    //modifica un episodio
    Route::put("/episodi/{idEpisodio}", [EpisodioController::class, 'update']);
    //elimina episodio
    Route::delete("/episodi/{idEpisodio}", [EpisodioController::class, 'destroy']);

    //mostra tutti gli indirizzi
    Route::get("/indirizzi", [IndirizzoController::class, 'index']);
    //mostra tutti gli indirizzi di una data tipologia
    Route::get("/indirizzi/tipologia/{idTipologiaIndirizzo}", [IndirizzoController::class, 'index']);
    //mostra tutti gli indirizzi di un dato comune
    Route::get("/indirizzi/comune/{idComune}", [IndirizzoController::class, 'index']);


    //mostra tutti i recapiti
    Route::get("/recapiti", [RecapitoController::class, 'index']);
    //mostra tutti i recapiti di una data tipologia
    Route::get("/recapiti/tipologia/{idTipologiaRecapito}", [RecapitoController::class, 'index']);
});
