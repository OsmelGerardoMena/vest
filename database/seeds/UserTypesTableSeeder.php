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
            'activated_submodules' => '1,2,3,4,5,6,7,8,9',
        	'status_id' => '1',
        ]);

        DB::table('user_types')->insert([
        	'name' => 'Vendedor',
        	'activated_modules' => '1,3',
            'activated_submodules' => '1,2,5',
        	'status_id' => '1',
        ]);

        DB::table('user_types')->insert([
            'name' => 'Empresa',
            'activated_modules' => '3,4,6',
            'activated_submodules' => '5,6,8',
            'status_id' => '1',
        ]);
    }
}
