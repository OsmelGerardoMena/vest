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
        	'activated_modules' => '1,2,3,4,5',
            'activated_submodules' => '1,2,3,4,5,6,7,8,9,10,11,12',
        	'status_id' => '1',
        ]);

        DB::table('user_types')->insert([
        	'name' => 'Vendedor',
            'activated_modules' => '6,7',
            'activated_submodules' => '13,14',
        	'status_id' => '1',
        ]);

        DB::table('user_types')->insert([
            'name' => 'Empresa',
            'status_id' => '1',
        ]);
    }
}
