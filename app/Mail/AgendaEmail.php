<?php

namespace AtitudeAgenda\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AgendaEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $pedido;
    protected $agenda;
    protected $remetente;
    protected $pagamento;

    public function __construct(
        $pedido, 
        $agenda,
        $remetente,
        $pagamento)
    {
        $this->pedido = $pedido;
        $this->agenda = $agenda;
        $this->remetente = $remetente;
        $this->pagamento = $pagamento;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.agenda-markdown',
                                [
                                    'pedido' => $this->pedido,
                                    'agenda' => $this->agenda, 
                                    'remetente' => $this->remetente,
                                    'pagamento' => $this->pagamento
                                ]
                            );
    }
}
