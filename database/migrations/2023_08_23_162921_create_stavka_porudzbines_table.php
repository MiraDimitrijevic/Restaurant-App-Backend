<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStavkaPorudzbinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stavka_porudzbines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('porudzbina_id');
            $table->foreignId('stavka_menija_id');
            $table->double('kolicina');
            $table->double('iznos');
            $table->timestamps();

            $table->unique(array('id','porudzbina_id'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stavka_porudzbines');
    }
}
