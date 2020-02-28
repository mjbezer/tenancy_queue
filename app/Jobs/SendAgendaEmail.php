<?php

namespace AtitudeAgenda\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use AtitudeAgenda\Models\EmailConfig;
use AtitudeAgenda\Http\Controllers\ParametroController;
use Illuminate\Support\Facades\Auth;
use AtitudeAgenda\Mail\AgendaEmail;
use Illuminate\Support\Facades\DB;

class SendAgendaEmail  implements ShouldQueue

{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $destino;
    protected $pedido;
    protected $agenda;
    protected $remetente;
    protected $pagamento;
    protected $account;




    public function __construct(
        $destino, 
        $pedido, 
        $agenda,
        $remetente,
        $pagamento)
    {
        $this->destino = $destino;
        $this->pedido = $pedido;
        $this->agenda = $agenda;
        $this->remetente = $remetente;
        $this->pagamento = $pagamento;


    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::purge('tenant');
        config()->set('database.connections.tenant.database', 'atitudeagenda_01');
        DB::reconnect('tenant');
        EmailConfig::emailConfig();   
        $mailAgenda = Mail::to($this->destino)->send(new AgendaEmail($this->pedido, 
                                                            $this->agenda,
                                                            $this->remetente, 
                                                            $this->pagamento)
                                                        );
     
    }
}
