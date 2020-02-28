<?php

namespace AtitudeAgenda\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;



class ReagendamentoEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $pedido;
    protected $agenda;
    protected $remetente;

    public function __construct(
        $pedido,
        $agenda,
        $remetente )
    {
        $this->pedido = $pedido;
        $this->agenda = $agenda;
        $this->remetente = $remetente;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reagendamento-markdown',
                                    [
                                        'pedido' => $this->pedido,
                                        'agenda' => $this->agenda,
                                        'remetente' => $this->remetente
                                    ]
                                );
    }
}
