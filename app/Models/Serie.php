<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Serie extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "series";
    protected $primaryKey = "idSerie";

    protected $fillable = [
        "idCategoria",
        "titolo",
        "descrizione",
        "regista",
        "produttore",
        "attori",
        "annoUscita",
        "annoFine",
        "totStagioni",
        "totEpisodi",
        "idLocandina",
        "idTrailer"
    ];
}
