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
        // si estoy usando la propiedad redirectPath
        if (property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }

        return property_exists($this, 'redirectTo') ? 
            $this->redirectTo : '/home';
    }
}
