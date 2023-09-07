<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadnaSmenasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radna_smenas', function (Blueprint $table) {
            $table->id();
            $table->enum('smena', array('prva','druga'));
            $table->date('datum');
            $table->double('ukupanPromet')->default(0);
            $table->foreignId('konobar_id');
            $table->timestamps();

            $table->unique(array('smena','datum'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('radna_smenas');
    }
}
