<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

class Utente extends User
{
    use HasFactory, SoftDeletes;

    protected $table="utenti";
    protected $primaryKey="idUtente";

    protected $fillable=[
        "idPermesso",
        "idStato",
        "nome",
        "cognome",
        "sesso",
        "dataNascita",
        "comuneNascita",
        "provinciaNascita",
        "codFiscale",
        "created_at",
        "update_at"
    ];

    
     /**
     * Relazione con tabella Permesso, uno a uno
     * 
     * @return \Illuminate\Http\Response
     */
    public function permessoUtente() {
        return $this->belongsTo(Permesso::class, 'idPermesso', 'idPermesso');
    }
}