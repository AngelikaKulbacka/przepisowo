<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('uzytkownicy', function (Blueprint $table) {
            $table->text('imie');
            $table->text('nazwisko');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('uzytkownicy', function (Blueprint $table) {
            $table->dropColumn('imie');
            $table->dropColumn('nazwisko');
        });
    }
}
