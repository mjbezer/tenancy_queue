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
use AtitudeAgenda\Mail\PedidoEmail;


class SendPedidoEmail implements ShouldQueue

{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $destino;
    protected $pedido;
    protected $pessoa;
    protected $remetente;

    public function __construct( 
        $destino, 
        $pedido, 
        $pessoa,
        $remetente)
    {
        $this->destino = $destino;
        $this->pedido = $pedido;
        $this->pessoa = $pessoa;
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
       $mailPedido = Mail::to($this->destino)->send(new PedidoEMail($this->pedido, $this->pessoa, $this->remetente));
    }
}
