<?php

use Illuminate\Database\Seeder;

class IncentiveTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('incentive_types')->insert([
        	'name' => 'Cantidad',
        ]);

        DB::table('incentive_types')->insert([
        	'name' => 'Dólares',
        ]);
    }
}
