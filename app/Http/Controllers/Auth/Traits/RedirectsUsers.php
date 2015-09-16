<?php

namespace Vest\Http\Controllers\Auth\Traits;

trait RedirectsUsers
{
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }

        //redireccion despues de loguearse
        return property_exists($this, 'redirectTo') ? 
            $this->redirectTo : route('dashboard');
    }
}
