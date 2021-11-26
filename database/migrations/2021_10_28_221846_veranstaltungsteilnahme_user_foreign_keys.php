<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VeranstaltungsteilnahmeUserForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('veranstaltung_teilnahme', function (Blueprint $table) {
            $table->foreign('veranstaltung')
                ->references('id')
                ->on('veranstaltung')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('teilnehmer')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('veranstaltung_teilnahme');
        Schema::dropIfExists('veranstaltung');
        Schema::dropIfExists('users');
    }
}
