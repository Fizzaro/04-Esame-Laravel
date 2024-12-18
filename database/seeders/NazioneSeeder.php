<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nazione;

class NazioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = storage_path("app/csv/nazioni.csv");
        $file = fopen($csv, "r");
        while (($data = fgetcsv($file, 200, ",")) !== false) {
            Nazione::create(
                [
                    'idNazione' => $data[0],
                    'nazione' => $data[1],
                    'continente' => $data[2],
                    'iso' => $data[3],
                    'iso3' => $data[4],
                    'prefissoTelefonico' => $data[5]
                ]
            );
        }
    }
}
