<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VeranstaltungDokumentMapping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('VeranstaltungDokumentMapping', function (Blueprint $table) {
            $table->id();
            $table->foreignId('veranstaltung');
            $table->foreignId('dokument');
            $table->timestamps();

            $table->foreign('veranstaltung')
                ->references('id')
                ->on('veranstaltung')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('dokument')
                ->references('id')
                ->on('Dokumente')
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
        Schema::dropIfExists('VeranstaltungDokumentMapping');
    }
}
