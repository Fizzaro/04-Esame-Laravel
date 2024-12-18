<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Config extends Model
{
    use HasFactory, SoftDeletes;

    protected $table="configs";
    protected $primaryKey="idConfig";

    protected $fillable=[
        "chiave",
        "valore",
    ];

    
    /**
     * Ritorna il numero di tentativi di accesso
     * @return  \Illuminate\Http\Response
     */
    public static function tentativiAccesso()
    {
        $chiave = Config::where('chiave', 'tentativiAccesso')->first();
        return $chiave->valore;
    }

    /**
     * Ritorna la durata della sfida
     * @return  \Illuminate\Http\Response
     */
    public static function durataSfida()
    {
        $chiave = Config::where('chiave', 'durataSfida')->first();
        return $chiave->valore;
    }

    /**
     * Ritorna la durata della sessione
     * @return  \Illuminate\Http\Response
     */
    public static function durataSessione()
    {
        $chiave = Config::where('chiave', 'durataSessione')->first();
        return $chiave->valore;
    }

    /**
     * Ritorna il numero delle ultime password da tener presente
     * @return  \Illuminate\Http\Response
     */
    public static function nUltimePssw()
    {
        $chiave = Config::where('chiave', 'nUltimePssw')->first();
        return $chiave->valore;
    }
}
