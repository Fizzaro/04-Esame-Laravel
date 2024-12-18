<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Password extends Model
{
    use HasFactory, SoftDeletes;

    protected $table="passwords";
    protected $primaryKey="idPassword";

    protected $fillable=[
        "idUtente",
        "pssw",
        "sale"
    ];
    
    /**
     * Ritorna l'ultima password dell'utente
     * 
     * @param string $utente
     * @return App\Models\Password
     */
    protected static function ultimaPassword($utente) {
        //ordino le password dell'utente e torno il record con l'ultima
        $pssw = Password::where('idUtente', $utente)->orderby('idPassword', 'desc')->firstOrFail();
        return $pssw;
    }
}
