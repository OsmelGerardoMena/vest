<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('status')->insert([
        	'type' => 'active',
        ]);

        \DB::table('status')->insert([
        	'type' => 'inactive',
        ]);
    }
}
