<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('services')->delete();
        
        \DB::table('services')->insert(array (
            0 => 
            array (
                'id' => 1,
                'label' => 'Sea Freight',
                'icon' => NULL,
                'created_at' => '2022-04-02 10:54:48',
                'updated_at' => '2022-04-02 10:54:48',
            ),
            1 => 
            array (
                'id' => 2,
                'label' => 'Air Freight',
                'icon' => NULL,
                'created_at' => '2022-04-03 10:16:05',
                'updated_at' => '2022-04-03 10:16:05',
            ),
            2 => 
            array (
                'id' => 3,
                'label' => 'Break Bulk',
                'icon' => NULL,
                'created_at' => '2022-04-03 10:17:52',
                'updated_at' => '2022-04-03 10:17:52',
            ),
            3 => 
            array (
                'id' => 4,
                'label' => 'Warehousing',
                'icon' => NULL,
                'created_at' => '2022-04-03 10:18:21',
                'updated_at' => '2022-04-03 10:18:21',
            ),
            4 => 
            array (
                'id' => 5,
                'label' => 'LCL',
                'icon' => NULL,
                'created_at' => '2022-04-03 10:19:06',
                'updated_at' => '2022-04-03 10:19:06',
            ),
            5 => 
            array (
                'id' => 6,
                'label' => 'InLand',
                'icon' => NULL,
                'created_at' => '2022-04-03 10:19:13',
                'updated_at' => '2022-04-03 10:19:13',
            ),
        ));
        
        
    }
}