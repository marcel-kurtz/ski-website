<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Veranstaltung extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veranstaltung', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->dateTime('start');
            $table->dateTime('ende');

            $table->dateTime('anmelde_start');
            $table->dateTime('anmelde_ende');

            $table->boolean('active');
            $table->foreignId('ansprechpartner'); // user

            $table->decimal('preis', 7, 2); // max 99.999,99 €
            $table->integer('max_teilnehmer')->nullable();

            $table->text('beschreibung');
            $table->text('titel');

            $table->json('pflicht_angaben')->nullable();
            $table->json('freiwillige_angaben')->nullable();

            // foreign keys
            $table->foreign('ansprechpartner')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('veranstaltung');
    }
}
