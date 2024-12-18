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
        Schema::create('passwords', function (Blueprint $table) {
            $table->id('idPassword');
            $table->unsignedBigInteger('idUtente');
            $table->string('pssw');
            $table->string('sale')->nullable();
            
            $table->softDeletes();
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
        Schema::dropIfExists('passwords');
    }
};
