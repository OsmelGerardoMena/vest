<?php

use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('user_types')->insert([
        	'name' => 'Admin',
        	'activated_modules' => '1,2,3,4,5,6',
        	'status_id' => '1',
        ]);

        DB::table('user_types')->insert([
        	'name' => 'Seller',
        	'activated_modules' => '2,3',
        	'status_id' => '1',
        ]);
    }
}
