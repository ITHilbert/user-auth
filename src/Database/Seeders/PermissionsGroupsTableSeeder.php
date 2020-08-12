<?php

namespace ITHilbert\UserAuth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PermissionsGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('permissions_groups')->delete();

        \DB::table('permissions_groups')->insert(array (
            0 =>
            array (
                'id' => 1,
                'group_name' => 'user',
                'group_display' => 'Benutzer',
                'created_at' => '2020-08-10 13:25:31',
                'updated_at' => '2020-08-12 12:30:58',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'group_name' => 'role',
                'group_display' => 'Rollen',
                'created_at' => '2020-08-12 12:31:35',
                'updated_at' => '2020-08-12 12:31:35',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'group_name' => 'permission',
                'group_display' => 'Rechte',
                'created_at' => '2020-08-12 12:32:06',
                'updated_at' => '2020-08-12 12:32:06',
                'deleted_at' => NULL,
            ),
        ));


    }
}
