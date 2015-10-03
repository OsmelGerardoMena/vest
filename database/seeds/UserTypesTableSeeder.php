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
        /// Perfiles fijos para los usuarios ///
        \DB::table('user_types')->insert([
        	'name' => 'admin',
        ]);

        DB::table('user_types')->insert([
        	'name' => 'seller',
        ]);

        DB::table('user_types')->insert([
            'name' => 'company',
        ]);
    }

    //'activated_modules' => '1,2,3,4,5',
    //'activated_submodules' => '1,2,3,4,5,6,7,8,9,10,11,12,13,14',

    //'activated_modules' => '6,7',
    //'activated_submodules' => '15,16',

    //'activated_modules' => '6',
    //'activated_submodules' => '15',
}
