<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStavkaMenijasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stavka_menijas', function (Blueprint $table) {
            $table->id();
            $table->string('naziv');
            $table->double('cena');
            $table->text('opsirnije')->nullable();
            $table->text('napomene')->nullable();
            $table->enum('jedinicaMere',['l','ml','g','kg']);
            $table->foreignId('vrstaStavkeMenija_id');
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
        Schema::dropIfExists('stavka_menijas');
    }
}
