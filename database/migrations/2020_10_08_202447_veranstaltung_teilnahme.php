<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VeranstaltungTeilnahme extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veranstaltung_teilnahme', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('veranstaltung');
            $table->json('pflicht_angaben')->nullable();
            $table->json('freiwillige_angaben')->nullable();
            $table->foreignId('teilnehmer');
            $table->text('bemerkungen')->nullable();

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
    }
}
