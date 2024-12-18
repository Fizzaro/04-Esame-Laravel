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
        Schema::create('indirizzi', function (Blueprint $table) {
            $table->id('idIndirizzo');
            $table->unsignedBigInteger('idUtente');
            $table->unsignedBigInteger('idTipologiaIndirizzo');
            $table->unsignedBigInteger('idComune');
            $table->string('indirizzo', 255);
            $table->string('lat', 255);
            $table->string('long', 255);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idUtente')->references('idUtente')->on('utenti');
            $table->foreign('idTipologiaIndirizzo')->references('idTipologiaIndirizzo')->on('tipologia_indirizzi');
            $table->foreign('idComune')->references('idComune')->on('comuni');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indirizzi');
    }
};
