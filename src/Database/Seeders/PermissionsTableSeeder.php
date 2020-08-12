<?php

namespace ITHilbert\UserAuth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert(array (
            0 =>
            array (
                'id' => 1,
                'permission' => 'user_create',
                'permission_display' => 'Benutzer erstellen',
                'group_id' => 1,
                'crud' => 'create',
                'created_at' => '2020-08-10 13:25:31',
                'updated_at' => '2020-08-12 12:30:58',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'permission' => 'user_read',
                'permission_display' => 'Benutzer lesen',
                'group_id' => 1,
                'crud' => 'read',
                'created_at' => '2020-08-10 13:25:31',
                'updated_at' => '2020-08-12 12:30:58',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'permission' => 'user_edit',
                'permission_display' => 'Benutzer ändern',
                'group_id' => 1,
                'crud' => 'edit',
                'created_at' => '2020-08-10 13:25:31',
                'updated_at' => '2020-08-12 12:30:58',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'permission' => 'user_delete',
                'permission_display' => 'Benutzer delete',
                'group_id' => 1,
                'crud' => 'delete',
                'created_at' => '2020-08-10 13:25:31',
                'updated_at' => '2020-08-12 12:30:58',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'permission' => 'role_create',
                'permission_display' => 'Rollen erstellen',
                'group_id' => 2,
                'crud' => 'create',
                'created_at' => '2020-08-12 12:31:35',
                'updated_at' => '2020-08-12 12:31:35',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'permission' => 'role_read',
                'permission_display' => 'Rollen lesen',
                'group_id' => 2,
                'crud' => 'read',
                'created_at' => '2020-08-12 12:31:35',
                'updated_at' => '2020-08-12 12:31:35',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'permission' => 'role_edit',
                'permission_display' => 'Rollen ändern',
                'group_id' => 2,
                'crud' => 'edit',
                'created_at' => '2020-08-12 12:31:35',
                'updated_at' => '2020-08-12 12:31:35',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'permission' => 'role_delete',
                'permission_display' => 'Rollen delete',
                'group_id' => 2,
                'crud' => 'delete',
                'created_at' => '2020-08-12 12:31:35',
                'updated_at' => '2020-08-12 12:31:35',
                'deleted_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'permission' => 'permission_create',
                'permission_display' => 'Rechte erstellen',
                'group_id' => 3,
                'crud' => 'create',
                'created_at' => '2020-08-12 12:32:06',
                'updated_at' => '2020-08-12 12:32:06',
                'deleted_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'permission' => 'permission_read',
                'permission_display' => 'Rechte lesen',
                'group_id' => 3,
                'crud' => 'read',
                'created_at' => '2020-08-12 12:32:06',
                'updated_at' => '2020-08-12 12:32:06',
                'deleted_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'permission' => 'permission_edit',
                'permission_display' => 'Rechte ändern',
                'group_id' => 3,
                'crud' => 'edit',
                'created_at' => '2020-08-12 12:32:06',
                'updated_at' => '2020-08-12 12:32:06',
                'deleted_at' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'permission' => 'permission_delete',
                'permission_display' => 'Rechte delete',
                'group_id' => 3,
                'crud' => 'delete',
                'created_at' => '2020-08-12 12:32:06',
                'updated_at' => '2020-08-12 12:32:06',
                'deleted_at' => NULL,
            ),
        ));


    }
}
