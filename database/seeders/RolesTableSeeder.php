<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('roles')->delete();

        \DB::table('roles')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'Admin',
                'guard_name' => 'users',
                'created_at' => '2022-04-02 10:53:59',
                'updated_at' => '2022-04-02 10:53:59',
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'Service Provider',
                'guard_name' => 'users',
                'created_at' => '2022-04-02 10:54:10',
                'updated_at' => '2022-04-02 10:54:10',
            ),
            2 =>
            array(
                'id' => 3,
                'name' => 'Forwarder',
                'guard_name' => 'users',
                'created_at' => '2022-04-02 10:54:37',
                'updated_at' => '2022-04-02 10:54:37',
            ),
        ));
    }
}
