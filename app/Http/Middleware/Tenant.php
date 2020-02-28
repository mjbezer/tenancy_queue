<?php

namespace AtitudeAgenda\Http\Middleware;

use AtitudeAgenda\User;
use AtitudeAgenda\Support\TenantConnector;
Use Closure;

class Tenant {

    use TenantConnector;

    protected $user;

    public function __contruct(User $user)
    {
        $this->user =$user;
    }

    public function handle ($request, Closure $next)
    {
     
        if (($request->session()->get('tenant'))===null){
            return redirect()->route('login')->withErrors(['error' =>__('Usuário naõ existe, ou sua licença não está validada!')]);
        }
        $user= $this->user->find($request->session()->get('tenant'));
        $this->reconnect($user);
        $request->session()->put('banco_dados', $user);
        return $next($request);


    }

}