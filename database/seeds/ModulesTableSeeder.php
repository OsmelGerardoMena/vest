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
        /// Modulo y submodulos roles (perfiles) id-1
        $id = \DB::table('modules')->insertGetId([
            'description' => 'roles',
            'icon' => 'icon-address-book',
        ]);

        \DB::table('submodules')->insert([ //1
            'description' => 'list_profiles',
            'url' => '/dashboard/profiles',
            'module_id' => $id,
        ]);

        \DB::table('submodules')->insert([ //2
            'description' => 'add_profile',
            'url' => '/dashboard/profiles/create',
            'module_id' => $id,
        ]);
        
    	/// Modulo y submodulos users id-2
        $id = \DB::table('modules')->insertGetId([
        	'description' => 'users',
        	'icon' => 'icon-users',
        ]);

        \DB::table('submodules')->insert([ //3
        	'description' => 'list_users',
        	'url' => '/dashboard/users',
        	'module_id' => $id,
        ]);

        \DB::table('submodules')->insert([ //4
            'description' => 'add_user',
            'url' => '/dashboard/users/create',
            'module_id' => $id,
        ]);

        \DB::table('submodules')->insert([ //5
            'description' => 'list_companies',
            'url' => '/dashboard/companies',
            'module_id' => $id,
        ]);

        \DB::table('submodules')->insert([ //6
            'description' => 'list_sellers',
            'url' => '/dashboard/sellers',
            'module_id' => $id,
        ]);

        /// Modulo y submodulos products id-3
        $id = \DB::table('modules')->insertGetId([
            'description' => 'products',
            'icon' => 'icon-layers',
        ]);

        \DB::table('submodules')->insert([ //7
            'description' => 'list_products',
            'url' => '/dashboard/products',
            'module_id' => $id,
        ]);

        \DB::table('submodules')->insert([ //8
            'description' => 'add_product',
            'url' => '/dashboard/products/create',
            'module_id' => $id,
        ]);

        \DB::table('submodules')->insert([ //9
            'description' => 'contracts',
            'url' => '/dashboard/contracts',
            'module_id' => $id,
        ]);

        \DB::table('submodules')->insert([ //10
            'description' => 'benefits',
            'url' => '/dashboard/benefits',
            'module_id' => $id,
        ]);

        \DB::table('submodules')->insert([ //11
            'description' => 'incentives',
            'url' => '/dashboard/incentives',
            'module_id' => $id,
        ]);

        \DB::table('submodules')->insert([ //12
            'description' => 'trainings',
            'url' => '/dashboard/trainings',
            'module_id' => $id,
        ]);

        /// Modulo y submodulos clientes id-4
        $id = \DB::table('modules')->insertGetId([
            'description' => 'customers',
            'icon' => 'icon-smiley-circled',
        ]);

        \DB::table('submodules')->insert([ //13
            'description' => 'list_customers',
            'url' => '/dashboard/customers',
            'module_id' => $id,
        ]);

        /// Modulo y submodulos ventas id-5
        $id = \DB::table('modules')->insertGetId([
            'description' => 'sales',
            'icon' => 'glyphicon glyphicon-stats',
        ]);

        \DB::table('submodules')->insert([ //14
            'description' => 'list_sales',
            'url' => '/dashboard/allsales',
            'module_id' => $id,
        ]);

        /////////////////// Para vendedores y empresas
        
        /// Modulo y submodulos products id-6
        $id = \DB::table('modules')->insertGetId([
            'description' => 'my_products',
            'icon' => 'glyphicon glyphicon-th-list',
        ]);

        \DB::table('submodules')->insert([ //15
            'description' => 'my_products_list',
            'url' => '/dashboard/my-products',
            'module_id' => $id,
        ]);

        /// Modulo y submodulos products id-7
        $id = \DB::table('modules')->insertGetId([
            'description' => 'my_sales',
            'icon' => 'fa fa-money',
        ]);

        \DB::table('submodules')->insert([ //16
            'description' => 'my_sales',
            'url' => '/dashboard/sales',
            'module_id' => $id,
        ]);
    }
}
