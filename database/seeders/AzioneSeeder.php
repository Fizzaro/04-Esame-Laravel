<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Azione;

class AzioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Azione::create(["idAzione" => 1, "azione" => "leggere"]);
        Azione::create(["idAzione" => 2, "azione" => "creare"]);
        Azione::create(["idAzione" => 3, "azione" => "aggiornare"]);
        Azione::create(["idAzione" => 4, "azione" => "eliminare"]);
    }
}
