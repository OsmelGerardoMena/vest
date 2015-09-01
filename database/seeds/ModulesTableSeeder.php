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
        	'description' => 'list_users',
        	'url' => '/dashboard/users',
        	'module_id' => $id,
        ]);
        \DB::table('submodules')->insert([
            'description' => 'add_user',
            'url' => '/dashboard/users/create',
            'module_id' => $id,
        ]);

        /// Modulo y submodulos roles (perfiles)
        $id = \DB::table('modules')->insertGetId([
        	'description' => 'roles',
        	'icon' => 'icon-address-book',
        ]);

        \DB::table('submodules')->insert([
        	'description' => 'list_profiles',
        	'url' => '/dashboard/profiles',
        	'module_id' => $id,
        ]);
        \DB::table('submodules')->insert([
            'description' => 'add_profile',
            'url' => '/dashboard/profiles/create',
            'module_id' => $id,
        ]);

        /// Modulo y submodulos customers
        $id = \DB::table('modules')->insertGetId([
        	'description' => 'customers',
        	'icon' => 'fa fa-smile-o',
        ]);

        \DB::table('submodules')->insert([
        	'description' => 'list_customers',
        	'url' => '/dashboard/customers',
        	'module_id' => $id,
        ]);

        /// Modulo y submodulos sellers
        $id = \DB::table('modules')->insertGetId([
        	'description' => 'sellers',
        	'icon' => 'icon-suitcase',
        ]);

        \DB::table('submodules')->insert([
        	'description' => 'list_sellers',
        	'url' => '/dashboard/sellers',
        	'module_id' => $id,
        ]);

        /// Modulo y submodulos company
        $id = \DB::table('modules')->insertGetId([
        	'description' => 'company',
        	'icon' => 'icon-flag-circled',
        ]);

        \DB::table('submodules')->insert([
        	'description' => 'list_companies',
        	'url' => '/dashboard/company',
        	'module_id' => $id,
        ]);

        /// Modulo y submodulos products
        $id = \DB::table('modules')->insertGetId([
        	'description' => 'products',
        	'icon' => 'icon-layers',
        ]);

        \DB::table('submodules')->insert([
        	'description' => 'list_products',
        	'url' => '/dashboard/products',
        	'module_id' => $id,
        ]);

        \DB::table('submodules')->insert([
            'description' => 'add_product',
            'url' => '/dashboard/products/create',
            'module_id' => $id,
        ]);
    }
}
