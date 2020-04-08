<?php

namespace Database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Userroles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert([
            
            
            ['name' => 'member', 'includes' => null ],
            ['name' => 'vorstand' , 'includes' => 1],
            ['name' => 'admin', 'includes' => 2],
            ['name' => 'admin', 'includes' => 1],
        ]);
    }
}