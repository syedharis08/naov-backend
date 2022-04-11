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
                'id' => 1,
                'user_id' => 1,
                'forwarder_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'forwarder_id' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'forwarder_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 1,
                'forwarder_id' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 1,
                'forwarder_id' => 9,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}