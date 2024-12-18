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
        Schema::create('recapiti', function (Blueprint $table) {
            $table->id('idRecapito');
            $table->unsignedBigInteger('idUtente');
            $table->unsignedBigInteger('idTipologiaRecapito');
            $table->string('recapito', 255);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idUtente')->references('idUtente')->on('utenti');
            $table->foreign('idTipologiaRecapito')->references('idTipologiaRecapito')->on('tipologia_recapiti');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recapiti');
    }
};
