<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('products')->insert([
            'name' => 'General',
            'price' => 0.00,
            'url' => 'http://google.com',
            'creator' => 'Administrator',
            'company_id' => 2,
        ]);
    }
}
