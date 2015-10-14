<?php

use Illuminate\Database\Seeder;

class BenefitTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('benefit_types')->insert([
        	'name' => 'percentage',
        ]);

        DB::table('benefit_types')->insert([
        	'name' => 'bolivares',
        ]);
    }
}
