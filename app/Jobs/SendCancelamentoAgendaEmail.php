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
use AtitudeAgenda\Mail\CancelamentoAgendaEmail;


class SendCancelamentoAgendaEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $destino;
    protected $pedido;
    protected $agenda;
    protected $remetente;


    public function __construct(
        $destino, 
        $pedido, 
        $agenda,
        $remetente)
    {
        $this->destino = $destino;
        $this->pedido = $pedido;
        $this->agenda = $agenda;
        $this->remetente = $remetente;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       EmailConfig::emailConfig();   
       $mailPedido = Mail::to($this->destino)->send(new CancelamentoAgendaEmail($this->pedido, $this->agenda, $this->remetente));
    }
}
