<?php

namespace Vest\Http\Middleware;

use Closure;

use Illuminate\Contracts\Auth\Guard;

use Illuminate\Support\Facades\Session;

class IsSeller
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // si no es vendedor
        if ($request->user()->type_id != 2) {
            
            Session::flash('restricted_access', 
                        trans('messages.restricted_access'));
            
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
