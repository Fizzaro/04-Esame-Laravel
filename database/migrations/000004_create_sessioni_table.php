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
        Schema::create('sessioni', function (Blueprint $table) {
            $table->id('idSessione');
            $table->unsignedBigInteger('idUtente');
            $table->string('token', 500);
            $table->string('scadenza');
            
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
        Schema::dropIfExists('sessiones');
    }
};
