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

        /// Modulo y submodulos company
        $id = \DB::table('modules')->insertGetId([
            'description' => 'companies',
            'icon' => 'icon-flag-circled',
        ]);

        \DB::table('submodules')->insert([
            'description' => 'list_companies',
            'url' => '/dashboard/companies',
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

        \DB::table('submodules')->insert([
            'description' => 'contracts',
            'url' => '/dashboard/contracts',
            'module_id' => $id,
        ]);

        \DB::table('submodules')->insert([
            'description' => 'incentives',
            'url' => '/dashboard/incentives',
            'module_id' => $id,
        ]);

        \DB::table('submodules')->insert([
            'description' => 'benefits',
            'url' => '/dashboard/benefits',
            'module_id' => $id,
        ]);

        \DB::table('submodules')->insert([
            'description' => 'trainings',
            'url' => '/dashboard/trainings',
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

        /////////////////// Para vendedores
        $id = \DB::table('modules')->insertGetId([
            'description' => 'my_products',
            'icon' => 'glyphicon glyphicon-th-list',
        ]);

        \DB::table('submodules')->insert([
            'description' => 'my_products_list',
            'url' => '/dashboard/my-products',
            'module_id' => $id,
        ]);

        $id = \DB::table('modules')->insertGetId([
            'description' => 'sales',
            'icon' => 'fa fa-money',
        ]);

        \DB::table('submodules')->insert([
            'description' => 'my_sales',
            'url' => '/dashboard/sales',
            'module_id' => $id,
        ]);
    }
}
