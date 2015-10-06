<?php

namespace Vest\Providers;

//Modelos
//use Vest\User;

//Politicas (directivas)
//use Vest\Policies\UserPolicy;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    
    protected $policies = [
        //La politica del modelo User es la clase UserPolicy
        //\Vest\User::class => \Vest\Policies\UserPolicy::class
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        
        $gate->define('admin', function($user){
            return $user->isAdmin();
        });

        $gate->define('seller', function($user){
            return $user->isSeller();
        });

        $gate->define('company', function($user){
            return $user->isCompany();
        });
    }
}