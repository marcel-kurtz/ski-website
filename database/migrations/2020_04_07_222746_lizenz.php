<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Lizenz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lizenzen', function (Blueprint $table) {
            $table->id();

            $table->unsignedMediumInteger('user');
            $table->foreign('user')->references('id')->on('users');

            $table->enum( 'disziplin', ['Alpin','Snowboard','Telemark','Nordic','Skitour']);
            $table->enum( 'verband' , ['DSV', 'DSLV', 'ÖSV']);
            $table->enum( 'niveau' , ['C-Trainer', 'B-Trainer', 'C-Trainer', 'Level 1', 'Level 2' , 'Level 3' , 'Level 4']);

            $table->date('erhalten');

            $table->date('letzteFortbilung');
            $table->text('letzteFortbilungNummer');
            $table->text('letzteFortbilungTage');

            $table->text('letzterErsteHilfeKurs');

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
    }
}
