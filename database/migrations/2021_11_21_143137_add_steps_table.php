<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kroki', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_przepisu');
            $table->foreign('id_przepisu')->references('id')->on('przepisy');
            $table->text('opis');
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
        Schema::dropIfExists('kroki');
    }
}
