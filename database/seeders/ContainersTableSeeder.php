<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContainersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('containers')->delete();
        
        \DB::table('containers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '20\' SD',
                'is_active' => 1,
                'created_at' => '2022-04-30 21:09:55',
                'updated_at' => '2022-04-30 21:09:55',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '40\' SD',
                'is_active' => 1,
                'created_at' => '2022-04-30 21:10:27',
                'updated_at' => '2022-04-30 21:10:27',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '40\' HC',
                'is_active' => 1,
                'created_at' => '2022-04-30 21:11:11',
                'updated_at' => '2022-04-30 21:11:11',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '20\' OT',
                'is_active' => 1,
                'created_at' => '2022-04-30 21:11:21',
                'updated_at' => '2022-04-30 21:11:21',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => '40\' OT',
                'is_active' => 1,
                'created_at' => '2022-04-30 21:11:27',
                'updated_at' => '2022-04-30 21:11:27',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => '20\' RC',
                'is_active' => 1,
                'created_at' => '2022-04-30 21:11:33',
                'updated_at' => '2022-04-30 21:11:33',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => '40\' RC',
                'is_active' => 1,
                'created_at' => '2022-04-30 21:14:05',
                'updated_at' => '2022-04-30 21:14:05',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => '40\' RHC',
                'is_active' => 1,
                'created_at' => '2022-04-30 21:14:16',
                'updated_at' => '2022-04-30 21:14:16',
            ),
        ));
        
        
    }
}