<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecipeIngredient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('przepis_skladnik', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_przepisu');
            $table->foreign('id_przepisu')->references('id')->on('przepisy');

            $table->unsignedBigInteger('id_skladnika');
            $table->foreign('id_skladnika')->references('id')->on('skladniki');
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
        Schema::dropIfExists('przepis_skladnik');
    }
}
