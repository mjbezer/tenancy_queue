<?php

namespace AtitudeAgenda\Tenant;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class TenantManager{

    /**
    * Altera a conexão tenant para o usuário logado
    * @param User $user
    * @return void
    * @throws
    */

    static function setConnection($database)
    {
       // Apaga a conexão tenant, forçando o Laravel a voltar suas configurações de conexão para o padrão.
        DB::purge('tenant');

       // Setando os dados da nova conexão.

       config()->set('database.connections.tenant.database', $database);
     
        // reconecata ao banco setado

        DB::reconnect('tenant');

        //Testa a conexão

        Schema::connection('tenant')->getConnection()->reconnect();

    }




    
}