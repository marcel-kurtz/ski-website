<?php

use Illuminate\Database\Seeder;

use Database\seeds\Userroles;
use Database\seeds\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            Userroles::class,
            User::class,
        ]);

    }
}
