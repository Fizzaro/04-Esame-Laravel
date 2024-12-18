<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Autorizzazione extends Model
{
    use HasFactory;

    protected $table="autorizzazioni";
    protected $primaryKey="idAutorizzazione";

    protected $fillable=[
        "idUtente",
        "username",
        "sfida",
        "secretJWT"
    ];
   
    /**
     * Confronto l'utente con username sul DB per valutare se esiste o no
     * 
     * @param string $utente
     * @return boolean
     */
    public static function validaUsername($utente) {
        $valid = DB::table('utenti')->join('autorizzazioni', 'utenti.idUtente', '=', 'autorizzazioni.idUtente')
                                    ->where('autorizzazioni.username', '=', $utente)
                                    ->select('autorizzazioni.idUtente')->get()->count();
        return $valid > 0 ? true : false;
    }
}
