<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comune extends Model
{
    use HasFactory;

    protected $table="comuni";
    protected $primaryKey="idComune";

    protected $fillable=[
        "idNazione",
        "nome",
        "regione",
        "citta",
        "provincia",
        "CAP"
    ];
}
