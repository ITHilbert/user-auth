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
                'role' => 'dev',
                'role_display' => 'Developer',
            ),
            1 =>
            array (
                'id' => 2,
                'role' => 'admin',
                'role_display' => 'Admin',
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
