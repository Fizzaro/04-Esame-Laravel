<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id('idFilm');
            $table->unsignedBigInteger('idCategoria');
            $table->string('titolo', 255);
            $table->unsignedInteger('durata');
            $table->string('descrizione', 255);
            $table->string('regista', 255);
            $table->string('produttore', 255);
            $table->string('attori', 255);
            $table->date('annoUscita');
            $table->unsignedBigInteger('idLocandina');
            $table->unsignedBigInteger('idTrailer');
            $table->unsignedBigInteger('idVideo');
     
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idCategoria')->references('idCategoria')->on('categorie');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films');
    }
};
