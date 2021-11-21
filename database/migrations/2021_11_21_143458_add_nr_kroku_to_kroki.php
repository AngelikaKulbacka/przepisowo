<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNrKrokuToKroki extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kroki', function (Blueprint $table) {
            $table->integer('nr_kroku');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kroki', function (Blueprint $table) {
            $table->dropColumn('nr_kroku');
        });
    }
}
