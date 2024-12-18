<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            Categoria::create(["idCategoria" => 1, "categoria" => "Animazione"]);
            Categoria::create(["idCategoria" => 2, "categoria" => "Avventura"]);
            Categoria::create(["idCategoria" => 3, "categoria" => "Azione"]);
            Categoria::create(["idCategoria" => 4, "categoria" => "Biografico"]);
            Categoria::create(["idCategoria" => 5, "categoria" => "Comico"]);
            Categoria::create(["idCategoria" => 6, "categoria" => "Commedia"]);
            Categoria::create(["idCategoria" => 7, "categoria" => "Drammatico"]);
            Categoria::create(["idCategoria" => 8, "categoria" => "Fantascienza"]);
            Categoria::create(["idCategoria" => 9, "categoria" => "Giallo"]);
            Categoria::create(["idCategoria" => 10, "categoria" => "Horror"]);

        }
    }
}
