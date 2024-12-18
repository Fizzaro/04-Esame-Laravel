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
        Schema::create('permessi_azioni', function (Blueprint $table) {
            $table->id('idPermessoAzione');
            $table->unsignedBigInteger('idPermesso');
            $table->unsignedBigInteger('idAzione');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idPermesso')->references('idPermesso')->on('permessi');
            $table->foreign('idAzione')->references('idAzione')->on('azioni');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permessi_azioni');
    }
};
