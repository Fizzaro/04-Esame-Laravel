<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipologiaIndirizzo;

class TipologiaIndirizzoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipologiaIndirizzo::create(["idTipologiaIndirizzo" => 1, "tipo" => "Residenza"]);
        TipologiaIndirizzo::create(["idTipologiaIndirizzo" => 2, "tipo" => "Domicilio"]);
        TipologiaIndirizzo::create(["idTipologiaIndirizzo" => 3, "tipo" => "Indirizzo"]);
        TipologiaIndirizzo::create(["idTipologiaIndirizzo" => 4, "tipo" => "Ufficio"]);
        TipologiaIndirizzo::create(["idTipologiaIndirizzo" => 5, "tipo" => "Sede legale"]);
        TipologiaIndirizzo::create(["idTipologiaIndirizzo" => 6, "tipo" => "Sede operativa"]);
    }
}
