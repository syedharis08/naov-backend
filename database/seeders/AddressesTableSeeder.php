<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('addresses')->delete();
        
        \DB::table('addresses')->insert(array (
            0 => 
            array (
                'address' => 'Formanites Housing Society',
                'city_id' => 85572,
                'country_id' => 167,
                'created_at' => '2022-04-20 05:17:38',
                'id' => 1,
                'state_id' => 3176,
                'updated_at' => '2022-04-20 05:17:38',
                'user_id' => 10,
            ),
            1 => 
            array (
                'address' => 'Formanites Housing Society',
                'city_id' => 85572,
                'country_id' => 167,
                'created_at' => '2022-04-20 05:19:00',
                'id' => 2,
                'state_id' => 3176,
                'updated_at' => '2022-04-20 05:19:00',
                'user_id' => 11,
            ),
            2 => 
            array (
                'address' => 'Formanites Housing Society',
                'city_id' => 85572,
                'country_id' => 167,
                'created_at' => '2022-04-20 05:19:21',
                'id' => 3,
                'state_id' => 3176,
                'updated_at' => '2022-04-20 05:19:21',
                'user_id' => 12,
            ),
            3 => 
            array (
                'address' => 'Shadman',
                'city_id' => 85572,
                'country_id' => 167,
                'created_at' => '2022-04-20 05:23:32',
                'id' => 4,
                'state_id' => 3176,
                'updated_at' => '2022-04-20 05:23:32',
                'user_id' => 13,
            ),
            4 => 
            array (
                'address' => 'Wapda Town',
                'city_id' => 85572,
                'country_id' => 167,
                'created_at' => '2022-04-20 05:24:40',
                'id' => 5,
                'state_id' => 3176,
                'updated_at' => '2022-04-20 05:24:40',
                'user_id' => 14,
            ),
            5 => 
            array (
                'address' => 'Wapda Town',
                'city_id' => 85572,
                'country_id' => 167,
                'created_at' => '2022-04-20 05:44:52',
                'id' => 6,
                'state_id' => 3176,
                'updated_at' => '2022-04-20 05:44:52',
                'user_id' => 15,
            ),
            6 => 
            array (
                'address' => '123456',
                'city_id' => 85572,
                'country_id' => 167,
                'created_at' => '2022-04-20 19:15:59',
                'id' => 7,
                'state_id' => 3176,
                'updated_at' => '2022-04-20 19:15:59',
                'user_id' => 19,
            ),
            7 => 
            array (
                'address' => 'test',
                'city_id' => 85475,
                'country_id' => 167,
                'created_at' => '2022-04-20 19:16:32',
                'id' => 8,
                'state_id' => 3169,
                'updated_at' => '2022-04-20 19:16:32',
                'user_id' => 20,
            ),
            8 => 
            array (
                'address' => '123',
                'city_id' => 85475,
                'country_id' => 167,
                'created_at' => '2022-04-20 19:19:06',
                'id' => 9,
                'state_id' => 3169,
                'updated_at' => '2022-04-20 19:19:06',
                'user_id' => 21,
            ),
            9 => 
            array (
                'address' => 'Test',
                'city_id' => 85331,
                'country_id' => 167,
                'created_at' => '2022-04-20 19:20:47',
                'id' => 10,
                'state_id' => 3176,
                'updated_at' => '2022-04-20 19:20:47',
                'user_id' => 22,
            ),
        ));
        
        
    }
}