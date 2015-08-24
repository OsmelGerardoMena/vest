<?php

namespace Vest\Http\Controllers\Auth\Traits;

trait AuthenticatesAndRegistersUsers
{
    use AuthenticatesUsers, RegistersUsers {
        AuthenticatesUsers::redirectPath insteadof RegistersUsers;
    }
}
