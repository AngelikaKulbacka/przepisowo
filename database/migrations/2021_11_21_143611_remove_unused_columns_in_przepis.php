<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUnusedColumnsInPrzepis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('przepisy', function (Blueprint $table) {
            $table->dropColumn('skladniki');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('przepisy', function (Blueprint $table) {
            $table->text('skladniki');
        });
    }
}
