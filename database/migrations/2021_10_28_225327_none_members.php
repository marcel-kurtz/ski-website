<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NoneMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noneMembers', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('email');
            $table->timestamps();
            $table->foreignId('veranstaltung')->references('id')->on('veranstaltung');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('noneMembers');
    }
}
