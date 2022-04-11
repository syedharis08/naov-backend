<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_id' => 1,
                'company_name' => 'Hexaa User',
                'company_email' => 'Hexaa User',
                'name' => 'Hexaa User',
                'phone' => '14124545',
                'email' => 'user@user.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$reD68HWVpfvbUKStd6aSUevtTNNKbfGeKFAQ1ieCka1nuUSMVQzzK',
                'is_logged_in' => 0,
                'remember_token' => NULL,
                'created_at' => '2022-04-10 14:25:54',
                'updated_at' => '2022-04-10 14:25:54',
            ),
            1 => 
            array (
                'id' => 2,
                'role_id' => 2,
                'company_name' => 'forwarder@naov.com',
                'company_email' => 'naov Forwarder',
                'name' => NULL,
                'phone' => NULL,
                'email' => NULL,
                'email_verified_at' => NULL,
                'password' => NULL,
                'is_logged_in' => 0,
                'remember_token' => NULL,
                'created_at' => '2022-04-10 14:29:46',
                'updated_at' => '2022-04-10 14:29:46',
            ),
            2 => 
            array (
                'id' => 3,
                'role_id' => 2,
                'company_name' => 'Naov Forwarder',
                'company_email' => 'forwarder@naov.com',
                'name' => NULL,
                'phone' => NULL,
                'email' => NULL,
                'email_verified_at' => NULL,
                'password' => NULL,
                'is_logged_in' => 0,
                'remember_token' => NULL,
                'created_at' => '2022-04-10 14:30:25',
                'updated_at' => '2022-04-10 14:30:25',
            ),
            3 => 
            array (
                'id' => 4,
                'role_id' => 2,
                'company_name' => 'Naov Forwarder',
                'company_email' => 'forwarder@naov.com',
                'name' => NULL,
                'phone' => NULL,
                'email' => NULL,
                'email_verified_at' => NULL,
                'password' => NULL,
                'is_logged_in' => 0,
                'remember_token' => NULL,
                'created_at' => '2022-04-10 14:33:40',
                'updated_at' => '2022-04-10 14:33:40',
            ),
            4 => 
            array (
                'id' => 5,
                'role_id' => 2,
                'company_name' => 'Naov Forwarder 2',
                'company_email' => 'forwarder2@naov.com',
                'name' => NULL,
                'phone' => NULL,
                'email' => NULL,
                'email_verified_at' => NULL,
                'password' => NULL,
                'is_logged_in' => 0,
                'remember_token' => NULL,
                'created_at' => '2022-04-10 14:33:55',
                'updated_at' => '2022-04-10 14:33:55',
            ),
            5 => 
            array (
                'id' => 6,
                'role_id' => 2,
                'company_name' => 'Naov Forwarder 3',
                'company_email' => 'forwarder3@naov.com',
                'name' => NULL,
                'phone' => NULL,
                'email' => NULL,
                'email_verified_at' => NULL,
                'password' => NULL,
                'is_logged_in' => 0,
                'remember_token' => NULL,
                'created_at' => '2022-04-10 14:34:06',
                'updated_at' => '2022-04-10 14:34:06',
            ),
            6 => 
            array (
                'id' => 7,
                'role_id' => 2,
                'company_name' => 'Naov Forwarder 4',
                'company_email' => 'forwarder4@naov.com',
                'name' => NULL,
                'phone' => NULL,
                'email' => NULL,
                'email_verified_at' => NULL,
                'password' => NULL,
                'is_logged_in' => 0,
                'remember_token' => NULL,
                'created_at' => '2022-04-10 14:34:20',
                'updated_at' => '2022-04-10 14:34:20',
            ),
            7 => 
            array (
                'id' => 8,
                'role_id' => 2,
                'company_name' => 'Naov Forwarder 5',
                'company_email' => 'forwarder5@naov.com',
                'name' => NULL,
                'phone' => NULL,
                'email' => NULL,
                'email_verified_at' => NULL,
                'password' => NULL,
                'is_logged_in' => 0,
                'remember_token' => NULL,
                'created_at' => '2022-04-10 14:34:32',
                'updated_at' => '2022-04-10 14:34:32',
            ),
            8 => 
            array (
                'id' => 9,
                'role_id' => 2,
                'company_name' => 'Naov',
                'company_email' => 'forwarder9@naov.com',
                'name' => 'forwarder',
                'phone' => '14124545',
                'email' => 'forwarder9@naov.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$0RctZLaPTCXFu6VKL3V1PeTiUBZAbJrgaU4u52KoEImNajrM6B1QK',
                'is_logged_in' => 0,
                'remember_token' => NULL,
                'created_at' => '2022-04-11 04:40:13',
                'updated_at' => '2022-04-11 04:40:13',
            ),
        ));
        
        
    }
}