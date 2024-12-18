<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permesso;

class PermessoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permesso::create(["idPermesso" => 1, "permesso" => "Amministratore"]);
        Permesso::create(["idPermesso" => 2, "permesso" => "Membro"]);
        Permesso::create(["idPermesso" => 3, "permesso" => "Ospite"]);
    }
}
