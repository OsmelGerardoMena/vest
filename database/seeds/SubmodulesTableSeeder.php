<?php

use Illuminate\Database\Seeder;

class SubmodulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      	\DB::table('submodules')->insert([
        	'description' => 'list',
        	'url' => '/dashboard/users',
        	'modules_id' => '1',
        ]);

        \DB::table('submodules')->insert([
        	'description' => 'list',
        	'url' => '/dashboard/profiles',
        	'modules_id' => '2',
        ]);
    }
}
