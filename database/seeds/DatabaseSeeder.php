<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(StatusTableSeeder::class);
        $this->call(UserTypesTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(ModulesTableSeeder::class);

        Model::reguard();
    }
}
