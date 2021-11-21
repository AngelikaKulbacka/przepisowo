<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('przepisy', function (Blueprint $table) {
            $table->id();
            $table->text('nazwa');
            $table->text('skladniki');
            $table->text('opis_przygotowania');
            $table->unsignedBigInteger('id_uzytkownika');
            $table->foreign('id_uzytkownika')->references('id')->on('uzytkownicy');
            $table->text('typ');
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
        Schema::dropIfExists('przepisy');
    }
}
