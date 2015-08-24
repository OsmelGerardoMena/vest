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
        	'modules' => '1,2,16,7,8,17,10,11,13,14,4,5',
        	'status_id' => '1',
        ]);

        \DB::table('user_types')->insert([
        	'name' => 'Vendedor',
        	'modules' => '1,2,4',
        	'status_id' => '1',
        ]);

        \DB::table('user_types')->insert([
        	'name' => 'Proveedores',
        	'modules' => '7,8',
        	'status_id' => '1',
        ]);
    }
}
