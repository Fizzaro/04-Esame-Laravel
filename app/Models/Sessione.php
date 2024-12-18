<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessione extends Model
{
    use HasFactory;

    protected $table="sessioni";
    protected $primaryKey="idSessione";

    protected $fillable=[
        "idUtente",
        "scadenza",
        "token"
    ];


     /**
     * Aggiungo una sessione
     * @param string $utente
     * @param string $token
     */
    public static function aggiungiSessione($utente, $token) {
        //creo il record per la nuova sessione
        Sessione::create([
            'idUtente' => $utente,
            'token' => $token,
            'scadenza' => time() + Config::durataSessione()
        ]);
    }

      /**
     * Elimino una sessione
     * @param string $utente
     */
    public static function eliminaSessione($utente) {
        //creo il record per la nuova sessione
        Sessione::where('idUtente', $utente)->delete();
    }
}
