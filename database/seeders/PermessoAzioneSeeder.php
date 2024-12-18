<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermessoAzioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //uso DB::table perchè il model non esiste essendo una tabella pivot
        DB::table('permessi_azioni')->insert([
            ["idPermesso" => 1, "idAzione" => 1],
            ["idPermesso" => 1, "idAzione" => 2],
            ["idPermesso" => 1, "idAzione" => 3],
            ["idPermesso" => 1, "idAzione" => 4],
            ["idPermesso" => 2, "idAzione" => 1],
            ["idPermesso" => 2, "idAzione" => 3]
        ]);
    }
}
