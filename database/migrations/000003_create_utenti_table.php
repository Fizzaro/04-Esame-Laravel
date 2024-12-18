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
        Schema::create('utenti', function (Blueprint $table) {
            $table->id('idUtente');
            $table->unsignedBigInteger('idPermesso')->default(3);
            $table->unsignedBigInteger('idStato')->default(1);
            $table->string('nome',45);
            $table->string('cognome',45);
            $table->unsignedTinyInteger('sesso'); //0 maschio, 1 femmina
            $table->date('dataNascita');
            $table->string('comuneNascita');
            $table->string('provinciaNascita');
            $table->string('codFiscale');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idPermesso')->references('idPermesso')->on('permessi');
            $table->foreign('idStato')->references('idStato')->on('stati');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utenti');
    }
};
