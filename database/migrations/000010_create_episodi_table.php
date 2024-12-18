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
        Schema::create('episodi', function (Blueprint $table) {
            $table->id('idEpisodio');
            $table->unsignedBigInteger('idSerie');
            $table->string('titolo', 255);
            $table->unsignedInteger('durata');
            $table->string('descrizione', 255);
            $table->unsignedInteger('numEpisodio');
            $table->unsignedInteger('numStagione');
            $table->date('annoUscita');
            $table->unsignedBigInteger('idVideo');
     
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idSerie')->references('idSerie')->on('series');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodi');
    }
};
