<?php

namespace Vest\Providers;

//Modelos
use Vest\User;

//Politicas (directivas)
use Vest\Policies\UserPolicy;

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
        //La politica del modelo User es la clase UserTypePolicy
        User::class => UserPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        //$gate->define('is-admin', 'UserPolicy@administer');
        //$gate->define('is-seller', 'UserPolicy@sell');
        
        /*$gate->define('is-admin', function($user){
            return $user->isAdmin();
        });

        $gate->define('is-seller', function($user){
            return $user->isSeller();
        });*/
    }
}