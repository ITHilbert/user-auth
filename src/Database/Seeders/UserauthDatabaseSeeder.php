<?php

namespace ITHilbert\UserAuth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserauthDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
