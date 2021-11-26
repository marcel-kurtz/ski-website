<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserHasRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userHasRole', function (Blueprint $table) {
            $table->id();

            $table->timestamps();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('user_role_id')->constrained('user_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userHasRole');
    }
}
