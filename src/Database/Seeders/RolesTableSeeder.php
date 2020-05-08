<?php

namespace ITHilbert\UserAuth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->delete();

        DB::table('roles')->insert(array (
            0 =>
            array (
                'id' => 1,
                'role' => 'super',
                'role_display' => 'super admin',
            ),
            1 =>
            array (
                'id' => 2,
                'role' => 'admin',
                'role_display' => 'admin',
            ),
            2 =>
            array (
                'id' => 3,
                'role' => 'user',
                'role_display' => 'Anwender',
            ),
        ));
    }
}
