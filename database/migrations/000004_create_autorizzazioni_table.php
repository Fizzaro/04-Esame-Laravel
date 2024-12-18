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
        Schema::create('autorizzazioni', function (Blueprint $table) {
            $table->id('idAutorizzazione');
            $table->unsignedBigInteger('idUtente');
            $table->string('username');
            $table->string('sfida')->nullable();
            $table->string('secretJWT')->nullable();
          
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
        Schema::dropIfExists('autorizzazioni');
    }
};
