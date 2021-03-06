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
        	'name' => 'Gustavo Meza',
            'email' => 'adolfz10@gmail.com',
            'password' => bcrypt('secret'),
            'identifier' => '18244429',
            'mobile' => '0500500',
            'phone' => '0416-470-36-02',
            'address' => 'Ejido Calle 36',
            'type_id' => 1,
        ]);*/

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

    	//se crean 10 datos de prueba
        factory(Vest\User::class, 10)->create();
    }
}