<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonobarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konobars', function (Blueprint $table) {
            $table->id();
            $table->date('datumZaposlenja');
            $table->double('plata');
            $table->string('napomena')->nullable();
            $table->boolean('naOdmoru');
            $table->boolean('naBolovanju');
            $table->foreignId('user_id');
            $table->foreignId('nadredjeni_id');
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
        Schema::dropIfExists('konobars');
    }
}
