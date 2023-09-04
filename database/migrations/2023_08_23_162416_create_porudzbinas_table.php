<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePorudzbinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('porudzbinas', function (Blueprint $table) {
            $table->id();
            $table->double('ukupnaCena');
            $table->boolean('placeno')->default(false);
            $table->boolean('saPopustom')->default(false);
            $table->double('popust')->default(0);
            $table->dateTime('datumVremePorudzbine');
            $table->foreignId('konobar_id')->default(0);
            $table->foreignId('gost_id');
            $table->foreignId('radna_smena_id')->default(0);
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
        Schema::dropIfExists('porudzbinas');
    }
}
