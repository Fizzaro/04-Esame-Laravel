<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipologiaRecapito;

class TipologiaRecapitoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipologiaRecapito::create(["idTipologiaRecapito" => 1, "tipo" => "Fisso"]);
        TipologiaRecapito::create(["idTipologiaRecapito" => 2, "tipo" => "Mobile"]);
        TipologiaRecapito::create(["idTipologiaRecapito" => 3, "tipo" => "Email"]);
    }
}
