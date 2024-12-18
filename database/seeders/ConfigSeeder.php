<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Config;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Config::create(['chiave' => 'tentativiAccesso', 'valore' => 5]);
        Config::create(['chiave' => 'durataSfida', 'valore' => 60]);
        Config::create(['chiave' => 'durataSessione', 'valore' => 1000]);
        Config::create(['chiave' => 'nUltimePssw', 'valore' => 3]);
    }
}
