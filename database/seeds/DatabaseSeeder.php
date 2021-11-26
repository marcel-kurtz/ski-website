<?php

use Illuminate\Database\Seeder;

use Database\seeds\Userroles;
use Database\seeds\User;
use Database\seeds\VeranstaltungsSeeder;
use Database\seeds\VeranstaltunsTeilnahmenSeeder;


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
            User::class,
            Userroles::class,
            VeranstaltungsSeeder::class,
            VeranstaltunsTeilnahmenSeeder::class,
        ]);

    }
}
