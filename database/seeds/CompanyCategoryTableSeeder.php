<?php

use Illuminate\Database\Seeder;

class CompanyCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('company_categories')->insert([
            'name' => 'Default',
        ]);
    }
}