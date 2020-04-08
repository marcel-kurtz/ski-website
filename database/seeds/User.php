<?php
namespace Database\seeds;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'email' => 'Kontakt@marcelkurtz.de' ,
                'password' =>  '$2y$10$aAcqHCNaSfCjj5s5iAw7SeAxm/dRHZT3n9flo2rxOsM1tkkQTdbaC',
                'name' => 'Kurtz' ,
                'firstname' =>  'Marcel',
                'birthdate' => '1997-05-27' ,
                'strasse' => 'Königsberger Str. 12d' ,
                'plz' =>  21629,
                'ort' => 'Neu Wulmstorf' ,
                'tel'  =>  '+49 152 5428 6163',
                'role' => 'admin' ,
                'aktiv' => true,
            ],
        ]);
        DB::table('lizenzen')->insert([
            [
                'user' => 1 ,
                'disziplin' =>  'Alpin',
                'verband' => 'DSV' ,
                'niveau' =>  'B-Trainer',
                'erhalten' => '2019-07-12' ,
                'letzteFortbilung' => '2019-11-30' ,
                'letzteFortbilungNummer' =>  'O-19-1',
                'letzteFortbilungTage' => '6' ,
                'letzterErsteHilfeKurs'  =>  '2019-05-12',
            ],
        ]);
    }
}
