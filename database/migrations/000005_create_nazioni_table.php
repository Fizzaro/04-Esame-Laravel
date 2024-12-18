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
        Schema::create('nazioni', function (Blueprint $table) {
            $table->id('idNazione');
            $table->string('nazione', 45);
            $table->string('continente', 45);
            $table->char('iso', 2);
            $table->char('iso3', 3);
            $table->string('prefissoTelefonico', 45);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nazioni');
    }
};
