<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accesso extends Model
{
    use HasFactory;
    
    protected $table="accessi";
    protected $primaryKey="idAccesso";

    protected $fillable=[
        "idUtente",
        "accesso",
        "sale"
    ];
    

    /**
     * Conta il numero di accessi di un utente
     * @param string $utente
     * @return App\Models\Accesso
     */
    protected static function nAccessiUtente($utente) {
        //conto e torno il numero di accessi di un utente
        $accessi = Accesso::where('idUtente', $utente)->count();
        return $accessi;
    }

    /**
     * Aggiunge un tentativo di accesso fallito
     * @param string $utente
     */
    protected static function tentativoFallito($utente) {
        //creo il record per l'accesso fallito (0)
        Accesso::create([
            'idUtente' => $utente,
            'accesso' => 0
        ]);
    }

    /**
     * Elimina i tentativi di accesso fallito
     * @param string $utente
     */
    protected static function eliminaTentativiFalliti($utente) {
        //elimino i record dei tentativi falliti
        Accesso::where('idUtente', $utente)->delete();
    }

     /**
     * Aggiungo l'accesso avvenuto
     * @param string $utente
     */
    protected static function aggiungiAccesso($utente) {
        //creo il record per l'accesso riuscito (1)
        Accesso::create([
            'idUtente' => $utente,
            'accesso' => 1
        ]);
    }
}
