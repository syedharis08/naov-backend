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
                'created_at' => '2022-04-20 07:20:00',
                'id' => 1,
                'is_active' => 1,
                'name' => '40\'',
                'updated_at' => '2022-04-20 07:20:00',
            ),
            1 => 
            array (
                'created_at' => '2022-04-20 07:20:04',
                'id' => 2,
                'is_active' => 1,
                'name' => '40\'HC',
                'updated_at' => '2022-04-20 07:20:04',
            ),
        ));
        
        
    }
}