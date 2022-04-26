<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShipperUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('shipper_users')->delete();
        
        \DB::table('shipper_users')->insert(array (
            0 => 
            array (
                'created_at' => NULL,
                'id' => 1,
                'shipper_id' => 11,
                'updated_at' => NULL,
                'user_id' => 10,
            ),
            1 => 
            array (
                'created_at' => NULL,
                'id' => 2,
                'shipper_id' => 12,
                'updated_at' => NULL,
                'user_id' => 10,
            ),
            2 => 
            array (
                'created_at' => NULL,
                'id' => 3,
                'shipper_id' => 16,
                'updated_at' => NULL,
                'user_id' => 15,
            ),
            3 => 
            array (
                'created_at' => NULL,
                'id' => 4,
                'shipper_id' => 20,
                'updated_at' => NULL,
                'user_id' => 19,
            ),
        ));
        
        
    }
}