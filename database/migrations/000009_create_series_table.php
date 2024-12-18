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
        Schema::create('series', function (Blueprint $table) {
            $table->id('idSerie');
            $table->unsignedBigInteger('idCategoria');
            $table->string('titolo', 255);
            $table->string('descrizione', 255);
            $table->string('regista', 255);
            $table->string('produttore', 255);
            $table->string('attori', 255);
            $table->date('annoUscita');
            $table->date('annoFine');
            $table->unsignedInteger('totStagioni');
            $table->unsignedInteger('totEpisodi');
            $table->unsignedBigInteger('idLocandina');
            $table->unsignedBigInteger('idTrailer');
     
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
        Schema::dropIfExists('series');
    }
};
