<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Indirizzo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "indirizzi";
    protected $primaryKey = "idIndirizzo";

    protected $fillable = [
        "idUtente",
        "idTipologiaIndirizzo",
        "idComune",
        "indirizzo",
        "lat",
        "long"
    ];

    /**
     * Ritorno di appartenenza con tabella TipologiaIndirizzi, relazione molti a uno
     * 
     * @return \Illuminate\Http\Response
     */
    public function elencoIndirizziTipologia() {
        return $this->belongsTo(TipologiaIndirizzo::class, 'idTipologiaIndirizzo', 'idTipologiaIndirizzo');
    }
    
}
