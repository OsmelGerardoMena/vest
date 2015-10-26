<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*factory(Vest\User::class)->create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret'),
            'identifier' => '11111111',
            'mobile' => '0500500',
            'phone' => '08000800',
            'address' => 'Jardin de Balamb',
            'type_id' => 1,
        ]);*/
        // id = 1
        \DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret'),
            'identifier' => '11111111',
            'mobile' => '0500500',
            'phone' => '08000800',
            'address' => 'Jardin de Balamb',
            'type_id' => 1,
        ]);
        // id = 2
        \DB::table('users')->insert([
            'name' => 'General',
            'email' => 'general@gmail.com',
            'password' => bcrypt('123456'),
            'identifier' => 'J-0000000',
            'mobile' => '0000000000',
            'phone' => '0000000000',
            'address' => 'Any',
            'type_id' => 3,
            'company_category_id' => 1,
        ]);
        // id = 3
        \DB::table('users')->insert([
            'name' => 'Mercado las Pulgas',
            'email' => 'pulga@gmail.com',
            'password' => bcrypt('123456'),
            'identifier' => 'J-5789963',
            'mobile' => '777788899',
            'phone' => '04167778899',
            'address' => 'Merida',
            'type_id' => 3,
            'company_category_id' => 1,
        ]);

    	//se crean 10 datos de prueba
        factory(Vest\User::class, 9)->create();
    }
}