<?php

namespace Database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\UserRoles as UserRolesModel;

class Userroles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model1 = UserRolesModel::create(['name' => 'member' ]);
        $model2 = UserRolesModel::create(['name' => 'vorstand' ]);
        $model3 = UserRolesModel::create(['name' => 'veranstalter' ]);
        $model4 = UserRolesModel::create(['name' => 'admin' ]);

        DB::table('userHasRole')->insert(['user_id' => 1 ,'user_role_id' => $model1->id ,]);
        DB::table('userHasRole')->insert(['user_id' => 1 ,'user_role_id' => $model2->id ,]);
        DB::table('userHasRole')->insert(['user_id' => 1 ,'user_role_id' => $model3->id ,]);
        DB::table('userHasRole')->insert(['user_id' => 1 ,'user_role_id' => $model4->id ,]);
    }
}
