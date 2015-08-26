<?php

use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	/// Modulo y submodulos users
        $id = \DB::table('modules')->insertGetId([
        	'description' => 'users',
        	'icon' => 'icon-users',
        ]);

        \DB::table('submodules')->insert([
        	'description' => 'list',
        	'url' => '/dashboard/users',
        	'module_id' => $id,
        ]);
        \DB::table('submodules')->insert([
            'description' => 'add',
            'url' => '/dashboard/users/create',
            'module_id' => $id,
        ]);
        /// Modulo y submodulos users

        /// Modulo y submodulos roles
        $id = \DB::table('modules')->insertGetId([
        	'description' => 'roles',
        	'icon' => 'icon-address-book',
        ]);

        \DB::table('submodules')->insert([
        	'description' => 'list',
        	'url' => '/dashboard/profiles',
        	'module_id' => $id,
        ]);
        /// Modulo y submodulos roles

        /// Modulo y submodulos customers
        $id = \DB::table('modules')->insertGetId([
        	'description' => 'customers',
        	'icon' => 'fa fa-smile-o',
        ]);

        \DB::table('submodules')->insert([
        	'description' => 'list',
        	'url' => '/dashboard/customers',
        	'module_id' => $id,
        ]);
        /// Modulo y submodulos customers

        /// Modulo y submodulos sellers
        $id = \DB::table('modules')->insertGetId([
        	'description' => 'sellers',
        	'icon' => 'icon-suitcase',
        ]);

        \DB::table('submodules')->insert([
        	'description' => 'list',
        	'url' => '/dashboard/sellers',
        	'module_id' => $id,
        ]);
        /// Modulo y submodulos sellers

        /// Modulo y submodulos company
        $id = \DB::table('modules')->insertGetId([
        	'description' => 'company',
        	'icon' => 'icon-flag-circled',
        ]);

        \DB::table('submodules')->insert([
        	'description' => 'list',
        	'url' => '/dashboard/company',
        	'module_id' => $id,
        ]);
        /// Modulo y submodulos company

        /// Modulo y submodulos products
        $id = \DB::table('modules')->insertGetId([
        	'description' => 'products',
        	'icon' => 'icon-layers',
        ]);

        \DB::table('submodules')->insert([
        	'description' => 'list',
        	'url' => '/dashboard/products',
        	'module_id' => $id,
        ]);
        /// Modulo y submodulos products
    }
}
