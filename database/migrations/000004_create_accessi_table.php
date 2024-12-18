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
        Schema::create('accessi', function (Blueprint $table) {
            $table->id('idAccesso');
            $table->unsignedBigInteger('idUtente');
            $table->boolean('accesso');
            
            $table->timestamps();

            $table->foreign('idUtente')->references('idUtente')->on('utenti');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accessi');
    }
};
