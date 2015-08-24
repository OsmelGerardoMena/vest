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
        factory(Vest\User::class)->create([
        	'name' => 'Adolfo Meza',
        	'email' => 'adolfz10@gmail.com',
        	'password' => bcrypt('secret'),
        	'identifier' => '18244429',
            'type_id' => 1,
            'status_id' => 1,
        ]);

    	//se crean 10 datos de prueba
        //factory(Vest\User::class, 10)->create();
    }
}