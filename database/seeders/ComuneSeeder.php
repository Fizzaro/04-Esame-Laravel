<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comune;

class ComuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = storage_path("app/csv/comuniItaliani.csv");
        $file = fopen($csv, "r");
        while (($data = fgetcsv($file, 2000, ",")) !== false) {
            if ($data[3] != '') {
                $citta = $data[3];
            } else {
                $citta = $data[4];
            }
            Comune::create(
                [
                    'idComune' => $data[0],
                    'idNazione' => 1,
                    'comune' => $data[1],
                    'regione' => $data[2],
                    'citta' => $citta,
                    'provincia' => $data[5],
                    'cap' => $data[9]
                ]
            );
        }
    }
}
