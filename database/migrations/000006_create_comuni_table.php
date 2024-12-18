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
        Schema::create('comuni', function (Blueprint $table) {
            $table->id('idComune');
            $table->unsignedBigInteger('idNazione');
            $table->string('comune', 255);
            $table->string('regione', 255);
            $table->string('citta', 255);
            $table->string('provincia', 45);
            $table->string('cap', 15);
            
            $table->timestamps();
            
            $table->foreign('idNazione')->references('idNazione')->on('nazioni');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comuni');
    }
};
