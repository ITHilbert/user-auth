<?php

namespace ITHilbert\UserAuth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('permissions')->delete();
        DB::table('permissions')->insert(array (
            0 =>
            array (
                'id' => 1,
                'permission' => 'editUser',
                'permission_display' => 'Benutzerverwaltung'
            )
        ));
    }
}
