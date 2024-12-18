<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permesso extends Model
{
    use HasFactory, SoftDeletes;

    protected $table="permessi";
    protected $primaryKey="idPermesso";

    protected $fillable=[
        "permesso"
    ];

   
    /**
     * Relazione con tabella Azioni, molti a molti, attraverso il pivot permessi_azioni
     * 
     * @return \Illuminate\Http\Response
     */
    public function elencoAzioniPermesso() {
        return $this->belongsToMany(Azione::class, 'permessi_azioni', 'idPermesso', 'idAzione');
    }
}
