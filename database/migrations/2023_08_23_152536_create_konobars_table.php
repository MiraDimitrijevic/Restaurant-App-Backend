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
            $table->double('plata')->default(0);
            $table->string('napomena')->nullable()->default(null);
            $table->boolean('naOdmoru')->default(false);
            $table->boolean('naBolovanju')->default(false);
            $table->foreignId('user_id');
            $table->foreignId('nadredjeni_id')->default(false);
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
