<?php

namespace Vest\Http\Middleware;

use Closure;

use Illuminate\Contracts\Auth\Guard;

use Illuminate\Support\Facades\Session;

class IsActive
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
        // si el usuario se encuentra desactivado no podra ver su información
        if(!$this->auth->user()->isActive()){
            Session::flash('disabled', trans('messages.disabled'));
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
