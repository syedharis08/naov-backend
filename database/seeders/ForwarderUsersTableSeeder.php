<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ForwarderUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('forwarder_users')->delete();
        
        \DB::table('forwarder_users')->insert(array (
            0 => 
            array (
                'created_at' => NULL,
                'forwarder_id' => 4,
                'id' => 1,
                'updated_at' => NULL,
                'user_id' => 1,
            ),
            1 => 
            array (
                'created_at' => NULL,
                'forwarder_id' => 5,
                'id' => 2,
                'updated_at' => NULL,
                'user_id' => 1,
            ),
            2 => 
            array (
                'created_at' => NULL,
                'forwarder_id' => 6,
                'id' => 3,
                'updated_at' => NULL,
                'user_id' => 1,
            ),
            3 => 
            array (
                'created_at' => NULL,
                'forwarder_id' => 7,
                'id' => 4,
                'updated_at' => NULL,
                'user_id' => 1,
            ),
            4 => 
            array (
                'created_at' => NULL,
                'forwarder_id' => 9,
                'id' => 5,
                'updated_at' => NULL,
                'user_id' => 1,
            ),
            5 => 
            array (
                'created_at' => NULL,
                'forwarder_id' => 13,
                'id' => 6,
                'updated_at' => NULL,
                'user_id' => 10,
            ),
            6 => 
            array (
                'created_at' => NULL,
                'forwarder_id' => 14,
                'id' => 7,
                'updated_at' => NULL,
                'user_id' => 13,
            ),
            7 => 
            array (
                'created_at' => NULL,
                'forwarder_id' => 17,
                'id' => 8,
                'updated_at' => NULL,
                'user_id' => 15,
            ),
            8 => 
            array (
                'created_at' => NULL,
                'forwarder_id' => 18,
                'id' => 9,
                'updated_at' => NULL,
                'user_id' => 17,
            ),
            9 => 
            array (
                'created_at' => NULL,
                'forwarder_id' => 21,
                'id' => 10,
                'updated_at' => NULL,
                'user_id' => 19,
            ),
            10 => 
            array (
                'created_at' => NULL,
                'forwarder_id' => 22,
                'id' => 11,
                'updated_at' => NULL,
                'user_id' => 21,
            ),
        ));
        
        
    }
}