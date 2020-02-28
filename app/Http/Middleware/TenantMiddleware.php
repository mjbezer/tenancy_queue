<?php

namespace AtitudeAgenda\Http\Middleware;

use AtitudeAgenda\User;
use Illuminate\Support\Facades\Auth;
use AtitudeAgenda\Tenant\TenantManager;
Use Closure;

class TenantMiddleware
{

    public function __contruct()
    {
        //
    }

    public function handle ($request, Closure $next) 
    {
        if(auth()->check()){
             $database = auth()->user()->banco_dados;
             TenantManager::setConnection($database);
        }

        return $next($request);
    }
   

}