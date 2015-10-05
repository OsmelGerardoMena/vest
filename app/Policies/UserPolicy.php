<?php

namespace Vest\Policies;

use Vest\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     *
     * @return void
     */

    //Autoriza habilidad si es admin
    public function administer(User $user)
    {
    	return $user->isAdmin();
    }

	//Autoriza habilidad si es vendedor
    public function sell(User $user)
    {
    	return $user->isSeller();
    }
}
